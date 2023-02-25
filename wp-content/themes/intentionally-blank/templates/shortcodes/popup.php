<?php

function popup_short()
{

    ob_start();
    ?>
    <div class="form-pop" id="pop_up_content" style="display: none; max-width: 500px">
        <form id="add_feedback">
            <input type="text" name="art_name" id="art_name" class="required art_name" placeholder="Имя" value=""/>

            <input type="tel" name="art_tel" id="art_tel" class="required art_tel" placeholder="Ваш телефон" value=""/>

            <input style="display: none" type="text" name="art_subject" id="art_subject" class="art_subject" placeholder="Тема" value=""/>

            <textarea name="art_comments" id="art_comments" placeholder="Введите ваше обращение" rows="10" cols="30" class="required art_comments"></textarea>

            <input type="checkbox" name="art_anticheck" id="art_anticheck" class="art_anticheck" style="display: none !important;" value="true" checked="checked"/>

            <input type="text" name="art_submitted" id="art_submitted" value="" style="display: none !important;"/>

            <input  type="submit" id="submit-feedback" class="input-btn" value="Отправить"/>
        </form>
    </div>
    <div data-src="#pop_up_content" id="pop_up_btn" class="btn-form">
        <button class="pop-up__button button_red">
            Кликни
        </button>
    </div>


    <?php
    return ob_get_clean();
}

add_shortcode('popup', 'popup_short');
