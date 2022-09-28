<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Слайдер");
?>
<div class="container">
    <div class="b-top-slider">
        <div class="b-top-slider__element">
            <img class="b-top-slider__images" src="images/img.png">
            <h3 class="b-top-slider__title">LOREM</h3>
            <p class="b-top-slider__anons">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            <div class="b-top-slider__link-container">
                <a href="#" class="b-top-slider__detail-link">Detail</a>
            </div>
        </div>
        <div class="b-top-slider__element">
            <img class="b-top-slider__images" src="images/img.png">
            <h3 class="b-top-slider__title">LOREM</h3>
            <p class="b-top-slider__anons">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            <div class="b-top-slider__link-container">
                <a href="#" class="b-top-slider__detail-link">Detail</a>
            </div>
        </div>
        <div class="b-top-slider__element">
            <img class="b-top-slider__images" src="images/img.png">
            <h3 class="b-top-slider__title">LOREM</h3>
            <p class="b-top-slider__anons">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut eni Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            <div class="b-top-slider__link-container">
                <a href="#" class="b-top-slider__detail-link">Detail</a>
            </div>
        </div>
    </div>
</div>

<style>
    .b-top-slider {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-between;
    }

    .b-top-slider__element {
        width: 30%;
        margin-right: 30px;
        box-shadow: 4px 4px 8px 0px rgb(34 60 80 / 20%);
        border-bottom: 3px solid #3f00ff;
        display: flex;
        flex-direction: column;
        padding-bottom: -15px;
        justify-content: flex-start;
    }
    .b-top-slider__images {
        object-fit: cover;
        width: 100%;
    }

    .b-top-slider__title {
        font-weight: bold;
    }
    .b-top-slider__anons {
        height:100%;
    }
    .b-top-slider__link-container {
        margin-bottom: 20px;

    }

    .b-top-slider__detail-link {
        text-decoration: none;
        color: #3f00ff!important;
        padding: 0px 10px 10px;

    }
</style>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>