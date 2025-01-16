@extends('layouts.admin_layout')
@section('section')
    <div class="main-content-section container">
        <div class="product-main-content-section">
            <div class="row">
                <div class="col-3 d-flex align-items-center justify-content-around">
                    <span class="open_check">Открытые счета</span>
                    <span></span>
                </div>
                <div class="col-9 d-flex justify-content-between align-items-center">
                    <input class="product-input-default product-main-content-header_search" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Поиск товара" type="text">
                    <svg class="input_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 21L16.657 16.657M16.657 16.657C17.3998 15.9141 17.9891 15.0322 18.3912 14.0615C18.7932 13.0909 19.0002 12.0506 19.0002 11C19.0002 9.9494 18.7932 8.90908 18.3912 7.93845C17.9891 6.96782 17.3998 6.08589 16.657 5.343C15.9141 4.60011 15.0321 4.01082 14.0615 3.60877C13.0909 3.20673 12.0506 2.99979 11 2.99979C9.94936 2.99979 8.90905 3.20673 7.93842 3.60877C6.96779 4.01082 6.08585 4.60011 5.34296 5.343C3.84263 6.84333 2.99976 8.87821 2.99976 11C2.99976 13.1218 3.84263 15.1567 5.34296 16.657C6.84329 18.1573 8.87818 19.0002 11 19.0002C13.1217 19.0002 15.1566 18.1573 16.657 16.657Z" stroke="#606368" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="product-content-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.66667 17.1429C8.66667 16.9155 8.75446 16.6975 8.91074 16.5368C9.06702 16.376 9.27899 16.2857 9.5 16.2857H14.5C14.721 16.2857 14.933 16.376 15.0893 16.5368C15.2455 16.6975 15.3333 16.9155 15.3333 17.1429C15.3333 17.3702 15.2455 17.5882 15.0893 17.7489C14.933 17.9097 14.721 18 14.5 18H9.5C9.27899 18 9.06702 17.9097 8.91074 17.7489C8.75446 17.5882 8.66667 17.3702 8.66667 17.1429ZM5.33333 12C5.33333 11.7727 5.42113 11.5547 5.57741 11.3939C5.73369 11.2332 5.94565 11.1429 6.16667 11.1429H17.8333C18.0543 11.1429 18.2663 11.2332 18.4226 11.3939C18.5789 11.5547 18.6667 11.7727 18.6667 12C18.6667 12.2273 18.5789 12.4453 18.4226 12.6061C18.2663 12.7668 18.0543 12.8571 17.8333 12.8571H6.16667C5.94565 12.8571 5.73369 12.7668 5.57741 12.6061C5.42113 12.4453 5.33333 12.2273 5.33333 12ZM2 6.85714C2 6.62981 2.0878 6.4118 2.24408 6.25105C2.40036 6.09031 2.61232 6 2.83333 6H21.1667C21.3877 6 21.5996 6.09031 21.7559 6.25105C21.9122 6.4118 22 6.62981 22 6.85714C22 7.08447 21.9122 7.30249 21.7559 7.46323C21.5996 7.62398 21.3877 7.71429 21.1667 7.71429H2.83333C2.61232 7.71429 2.40036 7.62398 2.24408 7.46323C2.0878 7.30249 2 7.08447 2 6.85714Z" fill="black"/>
                        </svg>
                    </div>
                    <div class="product-content-icon">
                        <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.07692 3.53571V3.92857H11.9231V3.53571C11.9231 3.01475 11.7205 2.51513 11.3598 2.14675C10.9992 1.77838 10.51 1.57143 10 1.57143C9.48997 1.57143 9.00083 1.77838 8.64018 2.14675C8.27953 2.51513 8.07692 3.01475 8.07692 3.53571ZM6.53846 3.92857V3.53571C6.53846 2.59798 6.90316 1.69866 7.55232 1.03559C8.20149 0.372512 9.08194 0 10 0C10.9181 0 11.7985 0.372512 12.4477 1.03559C13.0968 1.69866 13.4615 2.59798 13.4615 3.53571V3.92857H19.2308C19.4348 3.92857 19.6304 4.01135 19.7747 4.1587C19.919 4.30605 20 4.5059 20 4.71429C20 4.92267 19.919 5.12252 19.7747 5.26987C19.6304 5.41722 19.4348 5.5 19.2308 5.5H18.0708L16.6154 18.5177C16.5081 19.4764 16.059 20.3613 15.354 21.0035C14.6489 21.6457 13.737 22.0005 12.7923 22H7.20769C6.26297 22.0005 5.35113 21.6457 4.64604 21.0035C3.94095 20.3613 3.49194 19.4764 3.38462 18.5177L1.92923 5.5H0.769231C0.565218 5.5 0.369561 5.41722 0.225302 5.26987C0.0810437 5.12252 0 4.92267 0 4.71429C0 4.5059 0.0810437 4.30605 0.225302 4.1587C0.369561 4.01135 0.565218 3.92857 0.769231 3.92857H6.53846ZM4.91385 18.3386C4.97807 18.9136 5.2472 19.4445 5.66994 19.8299C6.09268 20.2154 6.63949 20.4284 7.20615 20.4286H12.7931C13.3597 20.4284 13.9065 20.2154 14.3293 19.8299C14.752 19.4445 15.0212 18.9136 15.0854 18.3386L16.5231 5.5H3.47769L4.91385 18.3386Z" fill="#121212"/>
                        </svg>
                    </div>
                    <div class="product-content-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.6667 18H19.9167C20.4687 17.9983 20.9976 17.7695 21.388 17.3635C21.7783 16.9575 21.9984 16.4074 22 15.8333V7.16667C21.9984 6.59256 21.7783 6.04245 21.388 5.6365C20.9976 5.23054 20.4687 5.00171 19.9167 5H4.08333C3.53131 5.00171 3.00236 5.23054 2.61202 5.6365C2.22167 6.04245 2.00165 6.59256 2 7.16667V15.8333C2.00165 16.4074 2.22167 16.9575 2.61202 17.3635C3.00236 17.7695 3.53131 17.9983 4.08333 18H5.33333" stroke="#121212" stroke-width="1.5" stroke-linejoin="round"/>
                            <path d="M17.67 11H6.33C5.59546 11 5 11.5758 5 12.2862V20.7138C5 21.4242 5.59546 22 6.33 22H17.67C18.4045 22 19 21.4242 19 20.7138V12.2862C19 11.5758 18.4045 11 17.67 11Z" stroke="#121212" stroke-width="1.5" stroke-linejoin="round"/>
                            <path d="M19 5V3.875C18.9983 3.37818 18.7672 2.90212 18.3574 2.55081C17.9475 2.1995 17.3921 2.00148 16.8125 2H7.1875C6.60787 2.00148 6.05248 2.1995 5.64262 2.55081C5.23276 2.90212 5.00173 3.37818 5 3.875V5" stroke="#121212" stroke-width="1.5" stroke-linejoin="round"/>
                            <path d="M19 10C19.5523 10 20 9.32843 20 8.5C20 7.67157 19.5523 7 19 7C18.4477 7 18 7.67157 18 8.5C18 9.32843 18.4477 10 19 10Z" fill="#121212"/>
                        </svg>
                    </div>
                </div>
            </div>
            <table class="restaurant_tables table table-striped mt-4">
                <thead>
                <tr>
                    <th>№</th>
                    <th>ID заказа</th>
                    <th>Зал</th>
                    <th>Время</th>
                    <th>Дата</th>
                    <th>Официант</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1.</td>
                    <td>#0000000000</td>
                    <td>VIP</td>
                    <td>10 Авг 2024, 15:00</td>
                    <td>00:00</td>
                    <td>Lorem ipsum </td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>#0000000000</td>
                    <td>VIP</td>
                    <td>10 Авг 2024, 15:00</td>
                    <td>00:00</td>
                    <td>Lorem ipsum </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>#0000000000</td>
                    <td>VIP</td>
                    <td>10 Авг 2024, 15:00</td>
                    <td>00:00</td>
                    <td>Lorem ipsum </td>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>#0000000000</td>
                    <td>VIP</td>
                    <td>10 Авг 2024, 15:00</td>
                    <td>00:00</td>
                    <td>Lorem ipsum </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
