<x-app-layout>
    <section class="home-section">
        <div class="home-content">
            <div class="row">
                <div class="container-fluid content">
                    <div class="card">
                        <div class="card-body">
                            <h1>(Разработка приостановлена)</h1>
                            <div class="table-responsive table-responsive-reference">
                                <table class="table table-hover table-bordered table-sm componentTable bg-white">
                                    <thead>
                                    <tr>
                                        <th>Сущность</th>
                                        <th>Тип операции</th>
                                        <th>Название</th>
                                        <th>Пользователь</th>
                                        <th>Дата</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select class="form-select">
                                                <option>не указана</option>
                                                <option>сущность 1</option>
                                                <option>сущность 2</option>
                                                <option>сущность 3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select">
                                                <option>не указана</option>
                                                <option>операция 1</option>
                                                <option>операция 2</option>
                                                <option>операция 3</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-select">
                                                <option>не указана</option>
                                                <option>программа 1</option>
                                                <option>программа 2</option>
                                                <option>программа 3</option>
                                            </select>
                                        </td>
                                        <td><input type="text" class="form-control"></td>
                                        <td><input type="date" class="form-control"></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($logs as $log)
                                        <tr>
                                            <td>
                                                {{ $log->operation->table->title }}
                                            </td>
                                            <td>
                                                {{ $log->operation->title }}
                                            </td>
                                            <td>
                                                {{ $log->itemable->title }}
                                            </td>
                                            <td>
                                                Пользователь{{ $log->uid }}
                                            </td>
                                            <td>
                                                {{ $log->created_at }}
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>История пока пуста...</tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
