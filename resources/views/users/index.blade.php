@extends('layouts.admin_layout')

@section('title')
    {{translate_title('Employees')}}
@endsection
@section('content')
    <style>
        #datatable-buttons td{
            overflow-wrap: break-word;
        }
    </style>
    <div id="loader"></div>
    <div class="main-content-section d-none" id="myDiv">
        <div class="order-section">
            <!-- Tab panes -->
            <div class="card-body">
                <div class="tab-content" id="employees_">
                    <div class="tab-pane fade show active" id="employees" role="tabpanel" aria-labelledby="employees-tab">
                        <div class="card">
                            <div class="right_button_create">
                                <button class="form_functions global-button" data-bs-toggle="modal" data-bs-target="#create_modal" data-url="{{route('users.store')}}">
                                    <img src="{{asset('menubar/client_active.png')}}" alt="" height="20px">
                                    {{translate_title('Новый Сотрудник')}}
                                </button>
                            </div>
                            <div class="card-body overflow-auto">
                                <table id="datatable-buttons" class="restaurant_tables table table-striped table-bordered dt-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{translate_title('Id')}}</th>
                                            <th>{{translate_title('Name')}}</th>
                                            <th>{{translate_title('Age')}}</th>
                                            <th>{{translate_title('Images')}}</th>
                                            <th>{{translate_title('Professions')}}</th>
                                            <th>{{translate_title('Captured image')}}</th>
                                            <th>{{translate_title('Status')}}</th>
                                            <th>{{translate_title('Functions')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user['id']}}</td>
                                            <td>{{$user['name']}}</td>
                                            <td>{{$user['age']}}</td>
                                            <td>
                                                <a class="product_images_column" onclick='getImages("{{implode(" ", $user['images'])}}")' data-bs-toggle="modal" data-bs-target="#carousel-modal">
                                                    @foreach($user['images'] as $image)
                                                        <div style="margin-right: 2px">
                                                            <img src="{{$image}}" alt="" height="50px">
                                                        </div>
                                                    @endforeach
                                                </a>
                                            </td>
                                            <td>
                                                @foreach($user['professions'] as $profession)
                                                    {{$profession}}
                                                @endforeach
                                            </td>
                                            <td>
                                                <img onclick="showImage('{{$user['captured_image']}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$user['captured_image']}}" alt="" height="50px">
                                            </td>
                                            <td>
                                                <a type="button" onclick="activateOrDisactivate('{{$user['status_']}}', '{{$user['id']}}')" class="btn border_r_10 {{$user['status_']==\App\Constants::ACTIVE?'edit_button':'delete_button'}} d-flex align-items-center justify-content-center btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#change_user_status">{{$user['status']}}</a>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-around align-items-center height_50 function_buttons">
                                                    <a class="edit_button btn" href="{{route('users.edit', $user['id'])}}">
                                                        <img src="{{asset('img/edit_icon.png')}}" alt="" height="18px">
                                                    </a>
                                                    <a class="edit_button btn" data-bs-toggle="modal" data-bs-target="#fullUserInfoModal" onclick='showUserInfo(
                                                    "{{$user['id']}}",
                                                    "{{$user['name']}}",
                                                    "{{$user['user_info']}}",
                                                    "{{$user['born_at']}}",
                                                    "{{$user['age']}}",
                                                    "{{$user['instagram_url']}}",
                                                    "{{$user['address']}}",
                                                    "{{implode(" ", $user['images'])}}",
                                                    "{{implode(", ", $user['professions'])}}",
                                                    "{{$user['captured_image']}}",
                                                    "{{$user['gender']}}",
                                                    "{{$user['status']}}",
                                                    "{{$user['email']}}",
                                                    "{{$user['created_at']}}")'>
                                                        <span class="fa fa-eye font-18"></span>
                                                    </a>
                                                    <button type="button" class="btn delete_button btn-sm waves-effect" data-bs-toggle="modal" data-bs-target="#delete_modal" data-url="{{route('users.destroy', $user['id'])}}">
                                                        <img src="{{asset('img/trash_icon.png')}}" alt="" height="18px">
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="change_user_status"
         aria-labelledby="scrollableModalTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('Activate or inactivate the user')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" action="{{route('change_status')}}" method="POST" novalidate>
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <div class="mb-3 text-center">
                                <label class="form-label"><b>{{translate_title('Status')}}</b></label>
                                <input type="checkbox" id="user_status" data-plugin="switchery" data-color="#3db9dc"/>
                            </div>
                        </div>
                        <input type="hidden" id="userId" name="user_id">
                        <input type="hidden" id="userStatus" name="status">
                        <div class="width_100_percent d-flex justify-content-between mt-4">
                            <button type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close')}}</button>
                            <button type="submit" class="btn modal_confirm">{{translate_title('Confirm')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    <div class="modal fade" tabindex="-1" role="dialog" id="create_modal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New user')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="modal-body needs-validation" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    @method('POST')
                    <div class="position-relative mb-3">
                        <label for="name" class="form-label">{{translate_title('Name')}}</label>
                        <input type="text" id="name" class="form-control" name="name" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter user name')}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label for="user_info" class="form-label">{{translate_title('User info')}}</label>
                        <input type="text" id="user_info" class="form-control" name="user_info" required>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter user user info.')}}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="basic-datepicker" class="form-label">{{translate_title('Born at')}}</label>
                        <input type="text" id="basic-datepicker" class="form-control flatpickr-input active" name="born_at" placeholder="Basic datepicker" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="male">{{translate_title('Male')}}</label>
                        <input type="radio" name="gender" id="male" value="{{\App\Constants::MALE}}" checked class="me-4">
                        <label for="female">{{translate_title('Female')}}</label>
                        <input type="radio" name="gender" id="female" value="{{\App\Constants::FEMALE}}">
                    </div>
                    <div class="mb-3">
                        <label for="instagram" class="form-label">{{translate_title('Instagram url')}}</label>
                        <input type="text" id="instagram" class="form-control" name="instagram_url">
                    </div>
                    <div class="position-relative mb-3">
                        <label for="instagram" class="form-label">{{translate_title('Professions')}}</label>
                        <select class="form-control select2-multiple mt-2" name="professions[]" data-toggle="select2" data-width="100%" multiple id="profession_select" data-placeholder="Choose ...">
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
                            Please choose professions.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image_input" class="form-label">{{translate_title('Images')}}</label>
                        <div class="d-flex">
                            <div class="default_image_content">
                                <img src="{{asset('img/default_image_plus.png')}}" alt="">
                            </div>
                            <span class="ms-1" id="images_quantity"></span>
                        </div>
                        <input type="file" id="image_input" name="images[]" class="form-control d-none" multiple>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{translate_title('Email')}}</label>
                        <input type="email" id="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="status_">{{translate_title('Status')}}</label>
                        <input type="checkbox" name="status" id="status_">
                    </div>

                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('Region')}}</label>
                        <select name="region_id" class="form-control" id="region_id" required>
                            <option value="" disabled selected>{{translate_title('Select region')}}</option>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter region.')}}
                        </div>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">{{translate_title('District')}}</label>
                        <select name="district_id" class="form-control" id="district_id" required>
                            <option value="" disabled selected>{{translate_title('Select district')}}</option>
                        </select>
                        <div class="invalid-tooltip">
                            {{translate_title('Please enter district.')}}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">{{translate_title('Address')}}</label>
                        <input type="text" id="address" class="form-control" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">{{translate_title('Password')}}</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="new_password" class="form-control" placeholder="Enter new password" name="new_password">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">{{translate_title('Password confirmation')}}</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_confirm" class="form-control" placeholder="Confirm password" name="password_confirmation">
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="region" id="region">
                    <input type="hidden" name="district" id="district">
                    <div class="width_100_percent d-flex justify-content-between mt-5">
                        <button type="button" class="btn modal_close" data-bs-dismiss="modal">{{translate_title('Close')}}</button>
                        <button type="submit" class="btn modal_confirm">{{translate_title('Create')}}</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="fullUserInfoModal"
         aria-labelledby="scrollableModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">{{translate_title('New user')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <table class="table table-borderless modal-body">
                    <thead>
                        <tr>
                            <th>{{translate_title('Title')}}</th>
                            <th>{{translate_title('Value')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{translate_title('id')}}</td>
                            <td id="user_info_id"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('name')}}</td>
                            <td id="user_info_name"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('user_info')}}</td>
                            <td id="user_info_user_info"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('born_at')}}</td>
                            <td id="user_info_born_at"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('age')}}</td>
                            <td id="user_info_age"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('instagram_url')}}</td>
                            <td id="user_info_instagram_url"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('address')}}</td>
                            <td id="user_info_address"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('images')}}</td>
                            <td id="user_info_images"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('professions')}}</td>
                            <td id="user_info_professions"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('captured_image')}}</td>
                            <td id="user_info_captured_image"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('gender')}}</td>
                            <td id="user_info_gender"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('status')}}</td>
                            <td id="user_info_status"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('email')}}</td>
                            <td id="user_info_email"></td>
                        </tr>
                        <tr>
                            <td>{{translate_title('created_at')}}</td>
                            <td id="user_info_created_at"></td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div id="carousel-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner" id="carousel_product_images">

                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{translate_title('Previous')}}</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">{{translate_title('Next')}}</span>
                    </a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        let page = false
        let current_region = ''
        let current_district = ''
        if(localStorage.getItem('region_id') != undefined && localStorage.getItem('region_id') != null){
            localStorage.removeItem('region_id')
        }
        if(localStorage.getItem('district_id') != undefined && localStorage.getItem('district_id') != null){
            localStorage.removeItem('district_id')
        }
        if(localStorage.getItem('region') != undefined && localStorage.getItem('region') != null){
            localStorage.removeItem('region')
        }
        if(localStorage.getItem('district') != undefined && localStorage.getItem('district') != null){
            localStorage.removeItem('district')
        }

        $(document).ready(function () {
            if($('#profession_select') != undefined && $('#profession_select') != null){
                $('#profession_select').select2({
                    dropdownParent: $('#create_modal') // modal ID ni kiriting
                });
            }
        })
        let user_info_id = document.getElementById('user_info_id')
        let user_info_name = document.getElementById('user_info_name')
        let user_info_user_info = document.getElementById('user_info_user_info')
        let user_info_born_at = document.getElementById('user_info_born_at')
        let user_info_age = document.getElementById('user_info_age')
        let user_info_instagram_url = document.getElementById('user_info_instagram_url')
        let user_info_address = document.getElementById('user_info_address')
        let user_info_images = document.getElementById('user_info_images')
        let user_info_professions = document.getElementById('user_info_professions')
        let user_info_captured_image = document.getElementById('user_info_captured_image')
        let user_info_gender = document.getElementById('user_info_gender')
        let user_info_status = document.getElementById('user_info_status')
        let user_info_email = document.getElementById('user_info_email')
        let user_info_created_at = document.getElementById('user_info_created_at')
        function showUserInfo(id, name, user_info, born_at, age,
        instagram_url, address, images, professions, captured_image, gender, status,
        email, created_at){
            user_info_id.innerText = id
            user_info_name.innerText = name
            user_info_user_info.innerText = user_info
            user_info_born_at.innerText = born_at
            user_info_age.innerText = age
            user_info_instagram_url.innerText = instagram_url
            user_info_address.innerText = address
            user_info_images.innerHTML = `<a class="product_images_column" onclick='getImages("${images}")' data-bs-toggle="modal" data-bs-target="#carousel-modal"> @foreach($user['images'] as $image) <div style="margin-right: 2px"> <img src="{{$image}}" alt="" height="50px"> </div> @endforeach </a>`
            user_info_professions.innerText = professions
            user_info_captured_image.innerHTML = `<img onclick="showImage('{{$user['captured_image']}}')" data-bs-toggle="modal" data-bs-target="#images-modal" src="{{$user['captured_image']}}" alt="" height="50px">`
            user_info_gender.innerText = gender
            user_info_status.innerText = status
            user_info_email.innerText = email
            user_info_created_at.innerText = created_at
        }

        let user_status = document.getElementById('user_status')
        let userId = document.getElementById('userId')
        let userStatus = document.getElementById('userStatus')
        function activateOrDisactivate(status, id) {
            setTimeout(function () {
                let switchery_default = document.querySelector('.switchery.switchery-default')
                let computedStyle = window.getComputedStyle(switchery_default);
                if(status == '{{\App\Constants::ACTIVE}}'){
                    if(computedStyle.backgroundColor == 'rgb(255, 255, 255)'){
                        switchery_default.click()
                    }
                    userStatus.value = '{{\App\Constants::NOT_ACTIVE}}'
                }else{
                    if(computedStyle.backgroundColor == 'rgb(61, 185, 220)'){
                        switchery_default.click()
                    }
                    userStatus.value = '{{\App\Constants::ACTIVE}}'
                }
                switchery_default.addEventListener('click', function () {
                    setTimeout(function () {
                        if(computedStyle.backgroundColor == 'rgb(255, 255, 255)'){
                            userStatus.value = '{{\App\Constants::NOT_ACTIVE}}'
                        }else{
                            userStatus.value = '{{\App\Constants::ACTIVE}}'
                        }
                    }, 14)
                })
            }, 244)
            user_status.value = status
            userId.value = id
        }
    </script>
    <script src="{{asset('js/cities.js')}}"></script>
@endsection
