@extends('layouts.layouts')

@section('title')
    {{translate_title('Users')}}
@endsection
@section('content')
    <style>
        .main{
            background-color: #000000;
        }
        .card{
            max-width: 744px;
            background-color: #000000;
            color:white;
            min-height: 100vh;
        }
        .card a{
            cursor: pointer;
        }
        .tab-content textarea{
            background-color: #1C1C1C !important;
            border: 0px !important;
            color: white!important;
            border-radius: 8px !important;
        }
        .tab-content input[type='text'],
        .tab-content input[type='number'],
        .tab-content input[type='date'],
        .tab-content select{
            background-color: #1C1C1C !important;
            border: 0px !important;
            color: white!important;
            border-radius: 8px !important;
        }
        .select2-container .select2-selection--multiple{
            background-color: #1C1C1C !important;
            border: 0px !important;
            color: white!important;
            padding: 4px !important;
            border-radius: 8px !important;
        }
        /*.form-floating label{*/
        /*    padding: 25px 0px 0px 13px !important;*/
        /*}*/
        @media only screen and (max-width: 299px) and (min-width: 250px) {
            .tab-content input[type='text'],
            .tab-content input[type='number'],
            .tab-content input[type='date'],
            .tab-content select {
                width: 214px;
            }
            .images_content{
                width: 214px;
            }
            .card-body{
                width: 244px;
            }
        }
        @media only screen and (max-width: 324px) and (min-width: 300px) {
            .tab-content input[type='text'],
            .tab-content input[type='number'],
            .tab-content input[type='date'],
            .tab-content select {
                width: 244px;
            }
            .images_content{
                width: 244px;
            }
            .card-body{
                width: 274px;
            }
        }
        @media only screen and (min-width: 325px) {
            .tab-content input[type='text'],
            .tab-content input[type='number'],
            .tab-content input[type='date'],
            .tab-content select {
                width: 270px;
            }
            .images_content{
                width: 270px;
            }
            .card-body{
                width: 300px;
            }
        }
        .select2-container .select2-selection--single{
            background-color: #1C1C1C !important;
            border: 0px !important;
            color: white!important;
            height: 52px !important;
            margin-top: 8px;
            display: flex;
            align-items: center;
            border-radius: 8px !important;
        }
        .tab-content span{
            color:white !important;
        }
        .input_info{
            color:grey;
            font-size: 14px;
            width:74%;
        }
        .your_photos_img{
            color:grey;
            font-size: 14px;
        }
        .gender_content{
            height: 52px;
            padding: 0px 14px;
            display: flex;
            align-items: center;
            background-color: #1C1C1C !important;
            border-radius: 8px !important;
        }
        .gender_content input{
            margin-left: 0px !important;
            margin-right: 8px !important;
            background-color: #1C1C1C !important;
            border: solid 2px grey;
        }

        .gender_content input:checked{
            background-color: #0d6efd !important;
        }
        .continue_button{
            background-color: white;
            color:black;
            height: 52px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            text-decoration: none;
        }
        @media only screen and (max-width: 600px) {
            .continue_button{
                width: 100%;
            }
        }
        @media only screen and (min-width: 601px) {
            .continue_button{
                width: 540px;
            }
        }
        .instagram{
            position: absolute;
            z-index: 24;
            margin-top: 17px;
            margin-left: 14px;
        }
        .your_profession_img{
            position: absolute;
            z-index: 24;
            margin-top: 7px;
            margin-left: 14px;
        }
        .instagram img{
            height: 34px;
        }
        #your_instagram input{
            padding-left: 60px!important;
        }
        #your_profession input{
            padding-left: 50px!important;
            padding: 8px;
        }
        #your_photos input, #your_photos .dropify-preview, #your_photos img{
            background-color: #1C1C1C;
        }
        #your_photos .dropify-wrapper{
            height: 153px;
            background-color: #1C1C1C !important;
            border: solid 1px #1C1C1C !important;
        }
        #your_photos .dropify-infos-inner{
            display: none;
        }
        .first_photo .dropify-wrapper{
            background-color: #1C1C1C !important;
        }
        .first_photo .dropify-message, .first_photo .dropify-preview{
            height: 284px;
        }
        .dropify-message{
             display: flex;
             align-items: center;
             justify-content: center;
         }
        .setCenter{
             display: flex !important;
             align-items: center !important;
             justify-content: center !important;
         }
        .other_photos{
            height: 154px !important;
        }
        .dropify-render{
            padding: 8px;
        }
        .back, .back:focus{
            color:white;
            text-decoration: none;
        }
        .registered_content{
            display:flex;
            align-items: center;
            height: 100vh;
        }
        .registered_content h2{
            color: green;
        }
        .dropify-message .file-icon p{
            display: none;
        }
        .dropify-font-upload:before,
        .dropify-wrapper .dropify-message span.file-icon:before {
            content: ''; /* E800 ni olib tashlaymiz */
            display: inline-block;
            width: 20px; /* Rasmingiz hajmi */
            height: 20px; /* Rasmingiz hajmi */
            background-image: url("{{asset('icon/plus.png')}}"); /* Shu yerda o'zingizning '+' belgili rasm manzilingizni kiriting */
            background-size: contain;
            background-repeat: no-repeat;
        }
        .dropify-wrapper.touch-fallback .dropify-message{
            padding:51px 0px;
        }
    </style>
    <div class="d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-1">
                    <a class="back nav-link" id="back"><span class="position-relative d-none"><span class="position-absolute font-24 fa fa-angle-left"></span><span class="ms-3">Back</span></span></a>
                    <p class="nav-link color_white">Dating</p>
                    <p class="width_15_percent"></p>
                </div>
                <div id="user_informations">
                    <ul class="nav nav-tabs nav-bordered nav-justified">
                        <li class="nav-item">
                            <a id="create_profile_link" aria-expanded="true" class="nav-link active"></a>
                        </li>
                        <li class="nav-item">
                            <a id="your_instagram_link" aria-expanded="false" class="nav-link"></a>
                        </li>
                        <li class="nav-item">
                            <a id="your_profession_link" aria-expanded="false" class="nav-link"></a>
                        </li>
                        <li class="nav-item">
                            <a id="your_photos_link" aria-expanded="false" class="nav-link"></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="create_profile">
                            <div class="user-create-section">
                                <div class="d-flex flex-column">
                                    <b>Создание профиля</b>
                                    <input type="text" class="form-control mt-2" placeholder="Имя" id="userName">
                                    <div class="form-floating mt-2">
                                        <textarea class="form-control" placeholder="Дизайнер из Дубая..." id="userInfo" style="height: 100px"> </textarea>
                                        <label for="userInfo">О вас</label>
                                    </div>
                                    <p class="input_info mt-2">Пример: Дизайнер из Дубая. Люблю сёрфинг.</p>
                                    <p class="input_info">Макс 120 символов</p>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-end flatpickr-input active" id="basic-datepicker" readonly="readonly" value="27-10-2006">
                                        <label for="basic-datepicker">Дата рождение</label>
                                    </div>

                                    <div class="position-relative mb-3">
                                        <div class="form-floating">
                                            <select name="region_id" class="text-center form-control" id="region_id" required>
                                                <option value="" disabled selected>Ваш область</option>
                                            </select>
                                            <label class="form-label">Область</label>
                                        </div>
                                        <div class="invalid-tooltip">
                                            Пожалуйста введите ваш район
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-check gender_content mb-2 me-4">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="male_" checked="">
                                            <label class="form-check-label" for="customradio1">Мужчина</label>
                                        </div>
                                        <div class="form-check gender_content mb-2">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="female_" >
                                            <label class="form-check-label" for="customradio1">Женщина</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="region" id="region">
{{--                                    <input type="hidden" name="district" id="district">--}}
                                </div>
                                <div class="nav">
                                    <div class="nav-item mt-4 width_100_percent d-flex justify-content-center">
                                        <a class="continue_button nav-link d-none" id="continue_to_your_instagram" href="#your_instagram" data-bs-toggle="tab" aria-expanded="false"><b>Продолжить</b></a>
                                        <a class="continue_button nav-link opacity_60" id="continue_to_your_instagram_fake"><b>Продолжить</b></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="your_instagram">
                            <div class="user-create-section">
                                <div class="d-flex flex-column">
                                    <b>Ваш instagram</b>
                                    <div class="position-relative">
                                        <span class="instagram">
                                            <img src="{{asset('img/instagram.png')}}" alt="">
                                        </span>
                                        <input type="text" class="form-control mt-2 p-3" value="instagram.com/" id="instagram_url">
                                        <div class="invalid-feedback">
                                            Пожалуйста введите ваш инстаграмм ссылку
                                        </div>
                                    </div>
                                    <p class="input_info mt-2">Инстаграмм должен быть открыт для всех</p>
                                </div>
                                <div class="nav">
                                    <div class="nav-item mt-4 width_100_percent d-flex justify-content-center">
                                        <a class="continue_button nav-link d-none" id="continue_to_your_profession" href="#your_profession" data-bs-toggle="tab" aria-expanded="false"><b>Продолжить</b></a>
                                        <a class="continue_button nav-link opacity_60" id="continue_to_your_profession_fake"><b>Продолжить</b></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="your_profession">
                            <div class="user-create-section">
                                <div class="d-flex flex-column">
                                    <div class="d-flex justify-content-center mt-2 mb-2">
                                        <img src="{{asset('/img/profession.jpg')}}" alt="" height="44px">
                                    </div>
                                    <b class="text-center">Индустрия</b>
                                    <p class="input_info text-center mt-2">Сфера вашей деятельности?</p>
                                    <div class="position-relative">
{{--                                        <span class="your_profession_img">--}}
{{--                                            <img src="{{asset('icon/header_search.png')}}" alt="">--}}
{{--                                        </span>--}}
                                        <select class="form-control select2-multiple mt-2" data-toggle="select2" data-width="100%" id="profession_select" data-placeholder="Choose ..." multiple>
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
                                    </div>
                                    <div class="invalid-feedback">
                                        Please choose a username.
                                    </div>
                                </div>
                                <div class="nav">
                                    <div class="nav-item mt-4 width_100_percent d-flex justify-content-center">
                                        <a class="continue_button nav-link d-none" id="continue_to_your_photos" href="#your_photos" data-bs-toggle="tab" aria-expanded="false"><b>Продолжить</b></a>
                                        <a class="continue_button nav-link opacity_60" id="continue_to_your_photos_fake"><b>Продолжить</b></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="your_photos">
                            <div class="user-create-section">
                                <div class="d-flex justify-content-between">
                                    <b>Фотографии профиля</b>
                                    <p class="your_photos_img">0 of 3</p>
                                </div>
                                <div class="d-flex justify-content-between images_content">
                                    <div class="width_49_percent first_photo">
                                        <div>
                                            <input type="file" data-plugins="dropify" id="your_photo_1"/>
                                        </div>
                                    </div>
                                    <div class="width_49_percent">
                                        <div class="other_photos">
                                            <input type="file" data-plugins="dropify" id="your_photo_2"/>
                                        </div>
                                        <div class="other_photos">
                                            <input type="file" data-plugins="dropify" id="your_photo_3"/>
{{--                                            <input type="file" data-plugins="dropify" id="your_photo_3" data-default-file="{{asset('img/default_image_plus.png')}}"/>--}}
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                                <div>
                                    <p class="input_info text-center mt-2">Сфера вашей деятельности?</p>
                                </div>
                                <div class="nav">
                                    <div class="nav-item mt-4 width_100_percent d-flex justify-content-center">
                                        <a class="continue_button nav-link d-none" id="confirm_your_personality"><b>Продолжить</b></a>
                                        <a class="continue_button nav-link opacity_60" id="confirm_your_personality_fake"><b>Продолжить</b></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="user-create-section d-none" id="your_personality">
                    <div>
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{asset("img/confirm_personal.jpg")}}" alt="" height="74">
                        </div>
                        <div class="text-center">
                            <p class="font-20"><b>Подверждение личности</b></p>
                            <p class="font-14">Все профили в нашем сообществе проходят верификацию</p>
                        </div>
                        <div class="d-flex mb-2">
                            <img src="{{asset("img/make_photo.jpg")}}" alt="" height="54">
                            <div class="d-flex flex-column">
                                <span class="font-14"><b>Сделайте селфи</b></span>
                                <span class="font-14 opacity-50"><b>Повторите позу и жест</b></span>
                            </div>
                        </div>
                        <div class="d-flex">
                            <img src="{{asset("img/check_notification.jpg")}}" alt="" height="54">
                            <div class="d-flex flex-column">
                                <span class="font-14"><b>Проверьте освещение</b></span>
                                <span class="font-14 opacity-50"><b>Вас должно быть хорошо видно</b></span>
                            </div>
                        </div>
                    </div>
                    <div class="nav">
                        <div class="nav-item mt-4 width_100_percent d-flex justify-content-center">
                            <a class="continue_button nav-link" id="take_a_selfie"><b>Продолжить</b></a>
                        </div>
                    </div>
                </div>
                <div class="user-create-section d-none" id="selfie">
                    <div class="mt-4">
                        <div>
                            <video id="video" width="240" height="320" autoplay></video>
                            <canvas id="canvas" width="240" height="320" style="display: none;"></canvas>
                        </div>
                        <span class="font-14 input_info opacity-50"><b>Сделаете селфи. Это фото используется толька для модерации.</b></span>
                    </div>
                    <div class="nav">
                        <div class="nav-item mt-4 width_100_percent d-flex justify-content-center">
                            <a class="continue_button nav-link" id="capture"><b>Take a selfie</b></a>
                        </div>
                    </div>
                 </div>
                <div class="user-create-section d-none" id="moderation">
                    <div>
                        <div class="d-flex justify-content-center mb-3">
                            <img src="{{asset("img/confirmed.jpg")}}" alt="" height="74">
                        </div>
                        <div class="text-center">
                            <p class="font-20"><b>Ваш профиль на модерации</b></p>
                            <p class="font-14 opacity_60">После прохождения модерации вы получите доступ к Dating и его преимушествам:</p>
                        </div>
                        <div class="d-flex mb-2">
                            <img src="{{asset("img/find_couple.jpg")}}" alt="" height="44">
                            <span class="ms-1">Знакомьтесь с умными и успешными мужчинами</span>
                        </div>
                        <div class="d-flex mb-2">
                            <img src="{{asset("img/checking.jpg")}}" alt="" height="44">
                            <span class="ms-1">Все профили провереныи проходят строгую модерацию</span>
                        </div>
                        <div class="d-flex mb-2">
                            <img src="{{asset("img/gift.jpg")}}" alt="" height="44">
                            <span class="ms-1">Получайте взнаграждения в Dating за общение в придложении</span>
                        </div>
                        <div class="d-flex mb-2">
                            <img src="{{asset("img/offer.jpg")}}" alt="" height="44">
                            <span class="ms-1">Приглашайте друзей и получайте бонусы</span>
                        </div>
                    </div>
                    <div class="nav">
                        <div class="nav-item mt-4 width_100_percent d-flex justify-content-center">
                            <button class="continue_button nav-link" id="accept"><b>Принято</b></button>
                        </div>
                    </div>
                 </div>
                <div class="d-none registered_content" id="registered_content">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <h2>{{translate_title('You are successfully registered!')}}</h2>
                    </div>
                </div>
            </div> <!-- end card-->
        </div>
    </div>

    <script>
        let page = false
        let current_region = ''
        let current_district = ''
        let complete_request_text = "Заполните все поля!"
        if(localStorage.getItem('region_id') != undefined && localStorage.getItem('region_id') != null){
            localStorage.removeItem('region_id')
        }
        if(localStorage.getItem('district_id') != undefined && localStorage.getItem('district_id') != null){
            localStorage.removeItem('district_id')
        }
        if(localStorage.getItem('region') != undefined && localStorage.getItem('region') != null){
            localStorage.removeItem('region')
        }
        // if(localStorage.getItem('district') != undefined && localStorage.getItem('district') != null){
        //     localStorage.removeItem('district')
        // }

        let sessionSuccess ="{{session('status')}}";
        if(sessionSuccess){
            toastr.success(sessionSuccess)
        }
        let sessionError ="{{session('error')}}";
        if(sessionError){
            toastr.warning(sessionError)
        }
    </script>
    <script src="{{asset('js/region.js')}}"></script>
    <script>
        let continue_to_your_instagram = document.getElementById('continue_to_your_instagram')
        let continue_to_your_profession = document.getElementById('continue_to_your_profession')
        let continue_to_your_photos = document.getElementById('continue_to_your_photos')

        let continue_to_your_instagram_fake = document.getElementById('continue_to_your_instagram_fake')
        let continue_to_your_profession_fake = document.getElementById('continue_to_your_profession_fake')
        let continue_to_your_photos_fake = document.getElementById('continue_to_your_photos_fake')

        let confirm_your_personality = document.getElementById('confirm_your_personality')
        let confirm_your_personality_fake = document.getElementById('confirm_your_personality_fake')
        let user_informations = document.getElementById('user_informations')
        let your_personality = document.getElementById('your_personality')
        let take_a_selfie = document.getElementById('take_a_selfie')
        let moderation = document.getElementById('moderation')
        let selfie = document.getElementById('selfie')
        let back = document.getElementById('back')
        let back_text = document.querySelector('#back span')

        let create_profile_link = document.getElementById('create_profile_link')
        let your_instagram_link = document.getElementById('your_instagram_link')
        let your_profession_link = document.getElementById('your_profession_link')
        let your_photos_link = document.getElementById('your_photos_link')
        let instagram_url = document.getElementById('instagram_url')
        let profession_select = document.getElementById('profession_select')
        let your_photo_1 = document.getElementById('your_photo_1')
        let your_photo_2 = document.getElementById('your_photo_2')
        let your_photo_3 = document.getElementById('your_photo_3')
        let userName = document.getElementById('userName')
        let userInfo = document.getElementById('userInfo')
        let born_at = document.getElementById('basic-datepicker')
        let region__ = document.getElementById('region')
        // let district__ = document.getElementById('district')
        let male_ = document.getElementById('male_')
        let female_ = document.getElementById('female_')
        let profession_values = '';
        let all_are_images = true

        continue_to_your_instagram.addEventListener('click', function () {
            create_profile_link.setAttribute('aria-expanded', "false")
            if(create_profile_link.classList.contains('active')){
                create_profile_link.classList.remove('active')
            }
            if(!create_profile_link.classList.contains('complete')){
                create_profile_link.classList.add('complete')
            }
            your_instagram_link.setAttribute('aria-expanded', "true")
            if(!your_instagram_link.classList.contains('active')){
                your_instagram_link.classList.add('active')
            }
        })
        continue_to_your_profession.addEventListener('click', function () {
            your_instagram_link.setAttribute('aria-expanded', "false")
            if(your_instagram_link.classList.contains('active')){
                your_instagram_link.classList.remove('active')
            }
            if(!your_instagram_link.classList.contains('complete')){
                your_instagram_link.classList.add('complete')
            }
            your_profession_link.setAttribute('aria-expanded', "true")
            if(!your_profession_link.classList.contains('active')){
                your_profession_link.classList.add('active')
            }
        })
        continue_to_your_photos.addEventListener('click', function () {
            your_profession_link.setAttribute('aria-expanded', "false")
            if(your_profession_link.classList.contains('active')){
                your_profession_link.classList.remove('active')
            }
            if(!your_profession_link.classList.contains('complete')){
                your_profession_link.classList.add('complete')
            }
            your_photos_link.setAttribute('aria-expanded', "true")
            if(!your_photos_link.classList.contains('active')){
                your_photos_link.classList.add('active')
            }
            your_photo_1.addEventListener('change', function () {
                setTimeout(function () {
                    let dropify_preview = document.querySelector('.first_photo .dropify-preview')
                    if(dropify_preview != null && dropify_preview != undefined) {
                        if (dropify_preview.style.display == 'block') {
                            if (!dropify_preview.classList.contains('setCenter')) {
                                dropify_preview.classList.add('setCenter')
                            }
                        } else {
                            if (dropify_preview.classList.contains('setCenter')) {
                                dropify_preview.classList.remove('setCenter')
                            }
                        }
                    }
                }, 94)
            })
        })
        create_profile_link.addEventListener('click', function () {
            continue_to_your_instagram.setAttribute('aria-expanded', "false")
            if(continue_to_your_instagram.classList.contains('active')){
                continue_to_your_instagram.classList.remove('active')
            }
        })
        function checkForImage(loadedFile){
            if (loadedFile) {
                const isImage = loadedFile.type.startsWith("image/");
                if (!isImage) {
                    all_are_images = false
                }
            } else {
                console.log("Fayl tanlanmagan.");
            }
        }
        confirm_your_personality.addEventListener('click', function () {
            all_are_images = true
            checkForImage(your_photo_1.files[0])
            checkForImage(your_photo_2.files[0])
            checkForImage(your_photo_3.files[0])

            if(all_are_images){
                if(your_personality.classList.contains('d-none')){
                    your_personality.classList.remove('d-none')
                }
                if(!user_informations.classList.contains('d-none')){
                    user_informations.classList.add('d-none')
                }
                if(back_text.classList.contains('d-none')){
                    back_text.classList.remove('d-none')
                }
                back.addEventListener('click', function () {
                    if(user_informations.classList.contains('d-none')){
                        user_informations.classList.remove('d-none')
                    }
                    if(!your_personality.classList.contains('d-none')){
                        your_personality.classList.add('d-none')
                    }
                })
            }else{
                toastr.error('You must select only images!');
            }
        })

        take_a_selfie.addEventListener('click', function () {
            if(selfie.classList.contains('d-none')){
                selfie.classList.remove('d-none')
            }
            if(!your_personality.classList.contains('d-none')){
                your_personality.classList.add('d-none')
            }
            if(back_text.classList.contains('d-none')){
                back_text.classList.remove('d-none')
            }
            back.addEventListener('click', function () {
                if(your_personality.classList.contains('d-none')){
                    your_personality.classList.remove('d-none')
                }
                if(!selfie.classList.contains('d-none')){
                    selfie.classList.add('d-none')
                }
            })
        })

        let instagram_array = [region_id, userName, userInfo]
        let instagram_inputs = [userName, userInfo]
        let instagram_selects = [region_id]
        let photos_inputs = [your_photo_1, your_photo_2, your_photo_3]
        let instagram_inputs_empty = false
        let dropify_clear = []
        continueButtons(instagram_inputs, continue_to_your_instagram, continue_to_your_instagram_fake, 'inputs')

        continueButtons(photos_inputs, confirm_your_personality, confirm_your_personality_fake, 'images')
        continueButtons(instagram_selects, continue_to_your_instagram, continue_to_your_instagram_fake, 'selects')
        function continueButtons(array, continueButton, continueButtonFake, type){
            for(let k=0; k<array.length; k++){
                if(type == 'inputs'){
                    array[k].addEventListener('input', function (e) {
                        dropify_clear = document.getElementsByClassName('dropify-clear')
                        continueButtonsSetFunc(continueButton, continueButtonFake)
                    })
                }else{
                    array[k].addEventListener('change', function (e) {
                        dropify_clear = document.getElementsByClassName('dropify-clear')
                        if(type == 'images'){
                            for(let k=0; k<dropify_clear.length; k++){
                                dropify_clear[k].addEventListener('click', function (e) {
                                    continueButtonsSetFunc(continueButton, continueButtonFake)
                                })
                            }
                        }
                        continueButtonsSetFunc(continueButton, continueButtonFake)
                    })
                }
            }
        }

        function continueButtonsSetFunc(continueButton, continueButtonFake){
            instagram_inputs_empty = false
            for(let n=0; n<instagram_array.length; n++) {
                if(instagram_array[n].value == '') {
                    instagram_inputs_empty = true
                }
            }
            if(!instagram_inputs_empty){
                if(continueButton.classList.contains('d-none')){
                    continueButton.classList.remove('d-none')
                }
                if(!continueButtonFake.classList.contains('d-none')){
                    continueButtonFake.classList.add('d-none')
                }
            }else{
                if(!continueButton.classList.contains('d-none')){
                    continueButton.classList.add('d-none')
                }
                if(continueButtonFake.classList.contains('d-none')){
                    continueButtonFake.classList.remove('d-none')
                }
            }
        }


        $(document).ready(function () {
            if($('#profession_select') != undefined && $('#profession_select') != null){
                $('#profession_select').select2()
                $('#profession_select').on('change', function() {
                    if ($(this).val() != '') {
                        profession_values = $(this).val();
                        if (continue_to_your_photos.classList.contains('d-none')) {
                            continue_to_your_photos.classList.remove('d-none')
                        }
                        if (!continue_to_your_photos_fake.classList.contains('d-none')) {
                            continue_to_your_photos_fake.classList.add('d-none')
                        }
                    } else {
                        if (!continue_to_your_photos.classList.contains('d-none')) {
                            continue_to_your_photos.classList.add('d-none')
                        }
                        if (continue_to_your_photos_fake.classList.contains('d-none')) {
                            continue_to_your_photos_fake.classList.remove('d-none')
                        }
                    }
                });
            }
        })
        continueButtonsInput(instagram_url, continue_to_your_profession, continue_to_your_profession_fake, 'input')
        function continueButtonsInput(url, continueButton, continueButtonFake, method){
            url.addEventListener(method, function (e) {
                console.log([e.target.value, e.target.value != '' && e.target.value != 'instagram.com/'])
                if(e.target.value != '' && e.target.value != 'instagram.com/' && e.target.value != 'instagram.com'){
                    if(continueButton.classList.contains('d-none')){
                        continueButton.classList.remove('d-none')
                    }
                    if(!continueButtonFake.classList.contains('d-none')){
                        continueButtonFake.classList.add('d-none')
                    }
                }else{
                    if(!continueButton.classList.contains('d-none')){
                        continueButton.classList.add('d-none')
                    }
                    if(continueButtonFake.classList.contains('d-none')){
                        continueButtonFake.classList.remove('d-none')
                    }
                }
            })
        }

        capture.addEventListener('click', function () {
            if(moderation.classList.contains('d-none')){
                moderation.classList.remove('d-none')
            }
            if(!selfie.classList.contains('d-none')){
                selfie.classList.add('d-none')
            }
            if(back_text.classList.contains('d-none')){
                back_text.classList.remove('d-none')
            }
            back.addEventListener('click', function () {
                if(selfie.classList.contains('d-none')){
                    selfie.classList.remove('d-none')
                }
                if(!moderation.classList.contains('d-none')){
                    moderation.classList.add('d-none')
                }
            })
        })


        // Doimiy prefiks
        const prefix_instagram = "instagram.com/";

        // Inputga faqat prefiksdan keyin yozish uchun
        instagram_url.addEventListener("input", (e) => {
            if (!e.target.value.startsWith(prefix_instagram)) {
                e.target.value = prefix_instagram; // Prefiksni qayta tiklash
            }
        });

        // Kursor pozitsiyasini faqat prefiksdan keyin saqlash
        instagram_url.addEventListener("keydown", (e) => {
            if (instagram_url.selectionStart < prefix_instagram.length && e.key !== "ArrowRight" && e.key !== "ArrowLeft") {
                e.preventDefault(); // Kursorni prefiks ichida harakatlanishini to'xtatish
            }
        });

        // Kursorni prefiksdan keyinga ko'chirish
        instagram_url.addEventListener("focus", () => {
            if (instagram_url.selectionStart < prefix_instagram.length) {
                instagram_url.setSelectionRange(prefix_instagram.length, prefix_instagram.length);
            }
        });
    </script>
    <script>

        let stream = null; // Declare stream in a higher scope
        let captured_image = '';

        take_a_selfie.addEventListener('click', function () {
            // Video va canvas elementlarini olish
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');
            const captureButton = document.getElementById('capture');
            captured_image = '';

            // Kamera kirish ruxsatini so'rash
            navigator.mediaDevices.getUserMedia({ video: true })
                .then((cameraStream) => {
                    stream = cameraStream; // Assign the stream to the higher-scope variable
                    video.srcObject = stream;
                })
                .catch((error) => {
                    console.error("Kamera kirishida xatolik:", error);
                });

            // Rasmni olish tugmachasini bosganda
            captureButton.addEventListener('click', () => {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

                // Canvasdagi rasmni Blob formatiga o‘tkazish
                canvas.toBlob((blob) => {
                    if (!blob) {
                        console.error('Blob obyekt yaratilmadi.');
                        return;
                    }
                    const formData = new FormData();
                    formData.append('image', blob, 'snapshot.png'); // "snapshot.png" nomi bilan
                    captured_image = formData;
                }, 'image/png');
            });
        });

        // Kamera yopish tugmachasi
        capture.addEventListener('click', function () {
            if (stream) {
                stream.getTracks().forEach(track => track.stop()); // Stop all tracks
                video.srcObject = null; // Clear the video element
                console.log('Camera closed');
            } else {
                console.error('Stream is not active or not initialized.');
            }
        });

    </script>
    <script>
        let accept = document.getElementById('accept');
        let registered_content = document.getElementById('registered_content');
        accept.addEventListener('click', function () {
            accept.disabled = true
            // FormData obyektini yaratish
            const formData = new FormData();

            // Matn maydonlari
            formData.append('name', userName.value);
            formData.append('info', userInfo.value);
            formData.append('born_at', born_at.value);
            formData.append('region', region__.value);
            // formData.append('district', district__.value);
            formData.append('male', male_.value);
            formData.append('female', female_.value);
            formData.append('instagram_url', instagram_url.value);
            profession_values.forEach(value_ => {
                formData.append('profession_select[]', value_);
            });

            // Fayl maydonlari
            formData.append('your_photo_1', your_photo_1.files[0]);
            formData.append('your_photo_2', your_photo_2.files[0]);
            formData.append('your_photo_3', your_photo_3.files[0]);

            // Agar rasm olingan bo'lsa, Blob formatidagi captured_image ni qo'shish
            if (captured_image != '') {
                formData.append('captured_image', captured_image.get('image'));
            } else {
                console.error("Captured image not found.");
            }
            let response_data = ''
            // AJAX so'rovini yuborish
            $.ajax({
                url: "/../api/user-store",
                method: 'POST',
                data: formData,
                processData: false, // Faylni JSON yoki query string sifatida o'zgartirmaslik uchun
                contentType: false, // Fayl uchun content turini avtomatik o'rnatish
                success: function (data) {
                    response_data = data
                    if(response_data.status == true){
                        toastr.success('Successfully created!');
                        if(registered_content.classList.contains('d-none')){
                            registered_content.classList.remove('d-none')
                        }
                        if(!moderation.classList.contains('d-none')){
                            moderation.classList.add('d-none')
                        }
                        if(!back.classList.contains('d-none')){
                            back.classList.add('d-none')
                        }
                    }else{
                        toastr.error('Something got wrong! try again');
                        if(accept.disabled == true){
                            accept.disabled = false
                        }
                    }
                },
                error: function (xhr, status, error) {
                    // Xatolarni qayta ishlash
                    console.log(xhr.responseText);
                    toastr.error('An error occurred: ' + xhr.status + ' ' + error);
                }
            });
        });
    </script>

@endsection
