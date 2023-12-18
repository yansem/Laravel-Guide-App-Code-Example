<?php

namespace App\Services\Program;

use App\Models\Chapter;
use App\Models\Guide;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ChapterService
{
    public function store(array $titles, array $texts, int $guideId): void
    {
        foreach ($titles as $index => $title) {
            Chapter::create([
                'guide_id' => $guideId,
                'title' => $title,
                'text_html' => $texts[$index],
                'text' => html_entity_decode(strip_tags($texts[$index])),
                'sort' => $index + 1
            ]);
        }
    }

    public function update(array $titles, array $texts, int $guideId): void
    {
        $guide = Guide::find($guideId);
        $oldChapters = $guide->chapters->flatten()->mapWithKeys(function ($item, $key) {
            return [$item['id'] => $item['title']];
        })->toArray();

        foreach ($titles as $index => $title) {
            if ($chapterId = array_search($title, $oldChapters)) {
                $guide->chapters()->where('id', $chapterId)->update([
                    'text_html' => $texts[$index],
                    'text' => html_entity_decode(strip_tags($texts[$index])),
                    'sort' => $index + 1
                ]);
                unset($oldChapters[$chapterId]);
            } else {
                Chapter::create([
                    'guide_id' => $guideId,
                    'title' => $title,
                    'text_html' => $texts[$index],
                    'text' => html_entity_decode(strip_tags($texts[$index])),
                    'sort' => $index + 1
                ]);
            }
        }
        $guide->chapters()->whereIn('id', array_keys($oldChapters))->delete();
    }

    public function parseHTML(UploadedFile $file, int $guideId): array
    {
        $doc = new \DOMDocument();
        $doc->loadHTMLFile($file);

        $images = $doc->getElementsByTagName('img');
        if ($images->count() > 0) {
            $decoded = [];
            foreach ($images as $index => $node) {
                $src = $node->getAttribute('src');
                if (preg_match('/^data:image\/(\w+);base64,/', $src, $type)) {
                    $data = substr($src, strpos($src, ',') + 1);
                    $type = strtolower($type[1]); // extension
                    $data = str_replace(' ', '+', $data);
                    $data = base64_decode($data);
                    if ($data === false) {
                        throw new \Exception(__('Image processing error'));
                    } else {
                        $decoded[] = ['data' => $data, 'type' => $type];
                    }
                } else {
                    throw new \Exception(__('Image processing error'));
                }
            }
            $imagesPath = 'guides/' . $guideId . '/images';
            $fullImagesPath = Storage::disk('public')->path($imagesPath);
            (new Filesystem)->cleanDirectory($fullImagesPath);
            foreach ($images as $index => $node) {
                $fileName = 'img' . $index . '.' . $decoded[$index]['type'];
                Storage::disk('public')->put($imagesPath . '/' . $fileName, $decoded[$index]['data']);
                $node->setAttribute('src', asset('storage/' . $imagesPath . '/' . $fileName));
                $node->setAttribute('alt', '');
            }
        }

        foreach ($doc->getElementsByTagName('*') as $node) {
            $node->removeAttribute('style');
        }

        foreach ($doc->getElementsByTagName('img') as $node) {
            $node->removeAttribute('width');
            $node->removeAttribute('height');
        }

        $html = $doc->saveHTML();
        $html = str_replace(['<span>', '</span>'], '', $html);
        $html = str_replace("\xc2\xa0", ' ', $html);
        $html = preg_replace('/<p>\s*<\/p>/u', '', $html); //удаление пустых параграфов
        preg_match_all('/<h2>(.*?)<\/h2>/su', $html, $titles); //извлечение заголовков разделов
        $this->validateTitles($titles[1]);
        preg_match_all('/<\/h2>(.*?)(<h2>|<\/body>)/su', $html, $texts); //извлечение содержимого разделов
        $this->validateTexts($texts[1]);

        return [$titles[1], $texts[1]];
    }

    private function validateTitles(array $titles): void
    {
        $min = 1;
        $max = 100;
        foreach ($titles as $index => $title) {
            $titleStr = preg_replace('/\s*/u', '', strip_tags($title)); //без пробелов и html-тегов
            $strlen = mb_strlen($title, 'utf-8');
            if ($title != strip_tags($title)) {
                throw new \Exception(__('In the name of the :chapter chapter there is formatting', ['chapter' => $index + 1]));
            } elseif ($titleStr === '') {
                throw new \Exception(__('Error when processing the name of the :chapter section.', ['chapter' => $index + 1]));
            } elseif ($strlen < $min || $strlen > $max) {
                throw new \Exception(__('The number of characters in the name of :chapter chapter must be from :min to :max.', ['chapter' => $index + 1, 'min' => $min, 'max' => $max]));
            }
        }
    }

    private function validateTexts(array $texts): void
    {
        $min = 1;
        $max = 16777215;
        foreach ($texts as $index => $text) {
            $textStr = preg_replace('/\s*/u', '', strip_tags($text)); //без пробелов и html-тегов
            $strlen = mb_strlen($text, 'utf-8');
            if ($textStr === '') {
                throw new \Exception(__('Error processing the contents of chapter :chapter.', ['chapter' => $index + 1]));
            } elseif ($strlen < $min || $strlen > $max) {
                throw new \Exception(__('The number of HTML characters in the content of chapter :chapter must be from :min to :max.', ['chapter' => $index + 1, 'min' => $min, 'max' => $max]));
            }
        }
    }
}
