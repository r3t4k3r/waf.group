<div class="container mt-4">
    <nav>
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a>
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                     </svg>
                </a>
            </li>
            <li class="breadcrumb-item">
                <a>Аккаунт</a>
             </li>
            <li class="breadcrumb-item active" aria-current="page">Настройки</li>
        </ol>
    </nav>
    <div class="row">
        <h1>Профиль и настройки<p></h1>
    </div>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card card-body border-0 shadow mb-4">
                <h2 class="h5 mb-4">Основная информация</h2>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="type">Тип аккаунта</label>
                                <input class="form-control" id="type" type="text" placeholder="Загрузка..." readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="email">Почта</label>
                                <input class="form-control" id="email" type="text" placeholder="Загрузка..." readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-3">
                            <label for="birthday">Номер договора</label>
                            <input class="form-control" id="number" type="text" placeholder="Загрузка..." readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="user-password">Количество услуг</label>
                                <input class="form-control" id="services" type="text" placeholder="Загрузка..." readonly>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-12 col-xl-6">
            <div class="card card-body border-0 shadow mb-4">
                <h3>Ваши услуги</h2>
                <form>
                    <button class="btn btn-gray-800 mt-2 animate-up-2" href="/services">Перейти</button>
                </form>
            </div>
        </div>
        <div class="col-12 col-xl-6">
            <div class="card card-body border-0 shadow mb-4">
                <h3>Ваши финансы</h2>
                <form>
                    <button class="btn btn-gray-800 mt-2 animate-up-2" href="/payment/balance">Перейти</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        query('/api/users.get/').then((user) => {
            $('#email').val(user.success.email)
            $('#number').val('№' + user.success.id)
            $('#services').val(user.success.services + ' шт.')
            if (user.success.level == 1) {
                
                $('#type').val('Пользователь')
            } else {
                
                $('#type').val('Администратор')
            }
        })
    });
</script>