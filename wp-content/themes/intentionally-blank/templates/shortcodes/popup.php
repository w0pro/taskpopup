<?php

function popup_short()
{
    ob_start();
    ?>
    <div class="pop-up" id="pop__up__content">
        <h3 class="pop-up__title">Получить набор файлов <br> для руководителя:</h3>
        <div class="pop-up__body">
            <div class="pop-up__body__img">
                <div class="pop-up__img__icons">
                    <img src="/wp-content/themes/intentionally-blank/assets/img/svg/icon__doc.svg" alt="">
                    <img src="/wp-content/themes/intentionally-blank/assets/img/svg/icon__xls.svg" alt="">
                    <img src="/wp-content/themes/intentionally-blank/assets/img/svg/icon__pdf.svg" alt="">
                    <img src="/wp-content/themes/intentionally-blank/assets/img/svg/icon__pdf.svg" alt="">
                    <img src="/wp-content/themes/intentionally-blank/assets/img/svg/icon__pdf.svg" alt="">
                    <img src="/wp-content/themes/intentionally-blank/assets/img/svg/icon__pdf.svg" alt="">
                    <img src="/wp-content/themes/intentionally-blank/assets/img/svg/icon__pdf.svg" alt="">
                </div>
                <img src="/wp-content/themes/intentionally-blank/assets/img/file__pop-up.webp" alt="">
            </div>
            <div class="pop-up__form">
                <form id="form__feedback" action="mail">
                    <div class="input__content">
                        <label for="form__email">Введите Email для получения файлов:</label>
                        <input type="text" name="form__email" id="form__email" class="form__email" placeholder="E-mail" value=""/>
                    </div>
                    <div class="input__content">
                        <label for="form__tel">Введите телефон для подтверждения доступа:</label>
                        <input type="text" name="form__tel" id="form__tel" class="form__tel" placeholder="+7 (000) 000-00-00" value=""/>
                    </div>
                    <input style="display: none" type="text" name="form__subject" id="form__subject" class="form__subject" placeholder="Тема" value=""/>

                    <input type="checkbox" name="form__anticheck" id="form__anticheck" class="form__anticheck" style="display: none !important;" value="true" checked="checked"/>

                    <input type="text" name="form__submitted" id="form__submitted" value="" style="display: none !important;"/>

                    <div class="form__submit_button">
                        <p>Скачать файлы:</p>
                        <img src="/wp-content/themes/intentionally-blank/assets/img/svg/form__hand__icon.svg" alt="">
                    </div>
                    <div class="form__desc">
                        <p>PDF 4,7 MB</p>
                        <p>DOC 8 MB</p>
                        <p>XLS 1.2 MB</p>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <div data-src="#pop__up__content" id="pop__up__btn">
        <button class="pop-up__button button_red">
            Кликни
        </button>
    </div>


    <?php
    return ob_get_clean();
}

add_shortcode('popup', 'popup_short');
