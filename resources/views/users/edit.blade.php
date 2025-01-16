@extends('layouts.admin_layout')

@section('title')
    {{translate_title('Edit employee')}}
@endsection
@section('content')
    <style>
        .delete_product_func{
            text-decoration: none;
        }
    </style>
    <div class="main-content-section">
        <div class="order-section">
            <div class="card">
                <div class="card-header">
                    <h4 class="mt-0 header-title">{{translate_title('Edit employee')}}</h4>
                </div>
                <div class="card-body">
                    <form class="modal-body needs-validation" action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label for="name" class="form-label">{{translate_title('Name')}}</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{$user['name']}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter percent.')}}
                                </div>
                            </div>
                            <div class="position-relative col-6 mb-3">
                                <label for="user_info" class="form-label">{{translate_title('User info')}}</label>
                                <input type="text" id="user_info" class="form-control" name="user_info" value="{{$user['user_info']}}" required>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter user user info.')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="male">{{translate_title('Male')}}</label>
                                <input type="radio" name="gender" id="male" value="{{\App\Constants::MALE}}" checked class="me-4">
                                <label for="female">{{translate_title('Female')}}</label>
                                <input type="radio" name="gender" id="female" value="{{\App\Constants::FEMALE}}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="instagram" class="form-label">{{translate_title('Instagram url')}}</label>
                                <input type="text" id="instagram" class="form-control" name="instagram_url" value="{{$user['instagram_url']}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 d-flex overflow-auto">
                                @foreach($images as $image)
                                    @php
                                        $avatar_main = storage_path('app/public/users/'.$image);
                                    @endphp
                                    @if(file_exists(storage_path('app/public/users/'.$image)))
                                        <div class="mb-3 user_image">
                                            <div class="d-flex justify-content-between">
                                                <img src="{{asset('storage/users/'.$image)}}" alt="">
                                                <a class="delete_product_func">X</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="col-6 mb-3">
                                <label for="image_input" class="form-label">{{translate_title('Images')}}</label>
                                <div class="d-flex">
                                    <div class="default_image_content">
                                        <img src="{{asset('img/default_image_plus.png')}}" alt="">
                                    </div>
                                    <span class="ms-1" id="images_quantity"></span>
                                </div>
                                <input type="file" id="image_input" name="images[]" class="form-control d-none" multiple>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 position-relative mb-3">
                                <label for="instagram" class="form-label">{{translate_title('Professions')}}</label>
                                <select class="form-control select2-multiple mt-2" name="professions[]" data-toggle="select2" data-width="100%" multiple="multiple" id="profession_select" data-placeholder="Choose ...">
                                    <optgroup label="Медицина и здравоохранение">
                                        <option value="Врач (хирург, терапевт, педиатр)">Врач (хирург, терапевт, педиатр)</option>
                                        <option value="Медсестра/медбрат">Медсестра/медбрат</option>
                                        <option value="Фармацевт">Фармацевт</option>
                                        <option value="Психолог">Психолог</option>
                                        <option value="Стоматолог">Стоматолог</option>
                                        <option value="Лаборант">Лаборант</option>
                                    </optgroup>
                                    <optgroup label="Образование и наука">
                                        <option value="Учитель (математики, физики, языка)">Учитель (математики, физики, языка)</option>
                                        <option value="Преподаватель вуза">Преподаватель вуза</option>
                                        <option value="Научный сотрудник (исследователь)">Научный сотрудник (исследователь)</option>
                                        <option value="Лаборант">Лаборант</option>
                                        <option value="Тьютор, наставник">Тьютор, наставник</option>
                                    </optgroup>
                                    <optgroup label="IT и телекоммуникации">
                                        <option value="Программист (веб, мобильный, backend, frontend)">Программист (веб, мобильный, backend, frontend)</option>
                                        <option value="Системный администратор">Системный администратор</option>
                                        <option value="Сетевой инженер">Сетевой инженер</option>
                                        <option value="Тестировщик (QA)">Тестировщик (QA)</option>
                                        <option value="Разработчик игр">Разработчик игр</option>
                                        <option value="Специалист по информационной безопасности">Специалист по информационной безопасности</option>
                                    </optgroup>
                                    <optgroup label="Инженерия и производство">
                                        <option value="Инженер (машиностроительный, электротехнический, строительный)">Инженер (машиностроительный, электротехнический, строительный)</option>
                                        <option value="Техник">Техник</option>
                                        <option value="Технолог (пищевая промышленность, производство)">Технолог (пищевая промышленность, производство)</option>
                                        <option value="Механик">Механик</option>
                                        <option value="Электрик">Электрик</option>
                                    </optgroup>
                                    <optgroup label="Финансы и экономика">
                                        <option value="Бухгалтер">Бухгалтер</option>
                                        <option value="Финансовый аналитик">Финансовый аналитик</option>
                                        <option value="Экономист">Экономист</option>
                                        <option value="Брокер">Брокер</option>
                                        <option value="Кредитный специалист">Кредитный специалист</option>
                                    </optgroup>
                                    <optgroup label="Маркетинг, реклама и PR">
                                        <option value="Маркетолог">Маркетолог</option>
                                        <option value="Специалист по рекламек">Специалист по рекламе</option>
                                        <option value="PR-менеджер">PR-менеджер</option>
                                        <option value="Контент-менеджер">Контент-менеджер</option>
                                        <option value="Бренд-менеджер">Бренд-менеджер</option>
                                    </optgroup>
                                    <optgroup label="Транспорт и логистика">
                                        <option value="Водитель (грузового транспорта, автобуса, легкового)">Водитель (грузового транспорта, автобуса, легкового)</option>
                                        <option value="Логист">Логист</option>
                                        <option value="Экспедитор">Экспедитор</option>
                                        <option value="Механик автотранспортар">Механик автотранспорта</option>
                                        <option value="Специалист по складскому учету">Специалист по складскому учету</option>
                                    </optgroup>
                                    <optgroup label="Торговля и продажи">
                                        <option value="Продавец-консультант">Продавец-консультант</option>
                                        <option value="Менеджер по продажам">Менеджер по продажам</option>
                                        <option value="Кассир">Кассир</option>
                                        <option value="Закупщик">Закупщик</option>
                                        <option value="Торговый представитель">Торговый представитель</option>
                                    </optgroup>
                                    <optgroup label="Юриспруденция и право">
                                        <option value="Юрист">Юрист</option>
                                        <option value="Адвокат">Адвокат</option>
                                        <option value="Нотариус">Нотариус</option>
                                        <option value="Судья">Судья</option>
                                        <option value="Прокурор">Прокурор</option>
                                    </optgroup>
                                    <optgroup label="Сфера услуг">
                                        <option value="Парикмахер">Парикмахер</option>
                                        <option value="Косметолог">Косметолог</option>
                                        <option value="Маникюрист">Маникюрист</option>
                                        <option value="Массажист">Массажист</option>
                                        <option value="Официант">Официант</option>
                                    </optgroup>
                                    <optgroup label="Государственная служба">
                                        <option value="Полицейский">Полицейский</option>
                                        <option value="Сотрудник МЧС">Сотрудник МЧС</option>
                                        <option value="Военный">Военный</option>
                                        <option value="Налоговый инспектор">Налоговый инспектор</option>
                                        <option value="Таможенник">Таможенник</option>
                                    </optgroup>
                                    <optgroup label="Культура и искусство">
                                        <option value="Музыкант">Музыкант</option>
                                        <option value="Актер">Актер</option>
                                        <option value="Художник">Художник</option>
                                        <option value="Дизайнер">Дизайнер</option>
                                        <option value="Режиссер">Режиссер</option>
                                    </optgroup>
                                    <optgroup label="Строительство и недвижимость">
                                        <option value="Архитектор">Архитектор</option>
                                        <option value="Прораб">Прораб</option>
                                        <option value="Крановщик">Крановщик</option>
                                        <option value="Маляр-штукатур">Маляр-штукатур</option>
                                        <option value="Оценщик недвижимости">Оценщик недвижимости</option>
                                    </optgroup>
                                    <optgroup label="Туризм и гостиничный бизнес">
                                        <option value="Гид-экскурсовод">Гид-экскурсовод</option>
                                        <option value="Администратор отеля">Администратор отеля</option>
                                        <option value="Туроператор">Туроператор</option>
                                        <option value="Аниматор">Аниматор</option>
                                        <option value="Специалист по бронированию">Специалист по бронированию</option>
                                    </optgroup>
                                    <optgroup label="Сельское хозяйство и экология">
                                        <option value="Агроном">Агроном</option>
                                        <option value="Ветеринар">Ветеринар</option>
                                        <option value="Лесник">Лесник</option>
                                        <option value="Эколог">Эколог</option>
                                        <option value="Рыболов">Рыболов</option>
                                    </optgroup>
                                </select>
                                <div class="invalid-feedback">
                                    {{translate_title('Please choose professions.')}}
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <label for="email" class="form-label">{{translate_title('Email')}}</label>
                                <input type="text" id="email" class="form-control" name="email" value="{{$user['email']}}">
                            </div>
                            <div class="col-4 mb-3 d-flex align-items-center">
                                <label class="form-label me-2" for="status_">{{translate_title('Status')}}</label>
                                <input type="checkbox" name="status" id="status_" @if((int)$user['status'] == \App\Constants::ACTIVE) 'checked' @endif>
                            </div>
                        </div>
                        <div class="row">
                            <div class="position-relative col-6 mb-3">
                                <label class="form-label">{{translate_title('Region')}}</label>
                                <select name="region_id" class="form-control" id="region_id" required>
                                    <option value="" disabled selected>{{translate_title('Select region')}}</option>
                                </select>
                                <div class="invalid-tooltip">
                                    {{translate_title('Please enter region.')}}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="address" class="form-label">{{translate_title('Address')}}</label>
                                <input type="text" id="address" class="form-control" name="address" value="{{$user->address?$user->address->name:''}}">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="new_password" class="form-label">{{translate_title('Password')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="new_password" class="form-control" placeholder="Enter new password" name="new_password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="password_confirm" class="form-label">{{translate_title('Password confirmation')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirm" class="form-control" placeholder="Confirm password" name="password_confirmation">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="region" id="region">
                        <div class="d-flex justify-content-end width_100_percent">
                            <button type="submit" class="btn modal_confirm">{{translate_title('Update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        let page = true
        @if($user->address)
            @if($user->address->cities)
                let current_region = "{{$user->address->cities->id??''}}"
            @else
                let current_region = ''
            @endif
        @else
            let current_region = ''
        @endif

        let user_image = document.getElementsByClassName('user_image')
        let delete_product_func = document.getElementsByClassName('delete_product_func')
        let deleted_text = "{{translate_title('User image was deleted')}}"
        let user_images = []
        @if(is_array($images))
            @foreach($images as $image)
                user_images.push("{{$image}}")
            @endforeach
        @endif

        function deleteProductFunc(item, val) {
            delete_product_func[item].addEventListener('click', function (e) {
                e.preventDefault()
                $.ajax({
                    url: '/api/delete-product',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        id:"{{$user->id}}",
                        image_file: user_images[item]
                    },
                    success: function(data){
                        if(data.status == true){
                            toastr.success(deleted_text)
                        }
                    }
                });
                if(!user_image[item].classList.contains('display-none')){
                    user_image[item].classList.add('display-none')
                }
            })
        }

        Object.keys(delete_product_func).forEach(deleteProductFunc)
        let professions_value = []
        @foreach($professions as $profession)
            professions_value.push("{{$profession}}")
        @endforeach
        $(document).ready(function() {
            // Select2 ni ishga tushiramiz
            $('#profession_select').select2();

            $('#profession_select').val(professions_value).trigger('change');
        });
    </script>
    <script src="{{asset('js/region.js')}}"></script>
@endsection
