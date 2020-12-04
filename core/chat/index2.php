<?php
/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;

$action = new WebItem();

$action->title = Azl . 'Чат';
$action->icon = 'fal fa-print';

$action->layout = true;
$action->debug = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

?>

<link rel="stylesheet" href="/render/chates/eyuf-chat/styles/index.css">

<div class="d-flex chat-frame">
    <div class="flex-shrink-0 card w-25">
        <div class="card-header text-white">
            <h4>Фойдаланувчилар</h4>
            <p class="mb-0">20 июнь, 2019 йил</p>
        </div>

        <div>
            <ul class="nav nav-tabs d-flex justify-content-center">
                <li class="active"><a data-toggle="tab" href="#chat">Чат</a></li>
                <li><a data-toggle="tab" href="#menu1">Приглашения</a></li>
                <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
            </ul>
            <div class="tab-content">
                <div id="chat" class="tab-pane fade active show in">
                    <div class="card-body p-0">
                        <ul class="users-list">
                            <li class="users-list__item">
                                <div class="user-chat user-chat--active media">
                                    <img class="user-chat__avatar shadow-sm mr-2" src="https://avatars.dicebear.com/api/avataaars/varun.svg?mood[]=happy" alt="">
                                    <div class="media-body">
                                        <h5 class="user-chat__name mb-0">Varun Dhavan</h5>
                                        <p class="user-chat__message user-chat__message--sent mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate delectus eos esse facilis fugit harum minima minus, perferendis perspiciatis praesentium quas quo recusandae repudiandae unde vero voluptatibus. Magnam, repudiandae.
                                        </p>
                                        <span class="user-chat__status user-chat__status--online">online</span>
                                    </div>
                                </div>
                            </li>

                            <li class="users-list__item">
                                <div class="user-chat media">
                                    <img class="user-chat__avatar shadow-sm mr-2" src="https://avatars.dicebear.com/api/avataaars/john.svg?mood[]=happy" alt="">
                                    <div class="user-chat__body media-body">
                                        <h5 class="user-chat__name mb-0">John Doe</h5>
                                        <p class="user-chat__message user-chat__message--sent mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate delectus eos esse facilis fugit harum minima minus, perferendis perspiciatis praesentium quas quo recusandae repudiandae unde vero voluptatibus. Magnam, repudiandae.
                                        </p>
                                        <span class="user-chat__status user-chat__status--online">online</span>
                                    </div>
                                </div>
                            </li>

                            <li class="users-list__item">
                                <div class="user-chat media">
                                    <img class="user-chat__avatar shadow-sm mr-2" src="https://avatars.dicebear.com/api/avataaars/jane.svg?mood[]=happy" alt="">
                                    <div class="user-chat__body media-body">
                                        <h5 class="user-chat__name mb-0">Jane Doe</h5>
                                        <p class="user-chat__message user-chat__message--sent mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate delectus eos esse facilis fugit harum minima minus, perferendis perspiciatis praesentium quas quo recusandae repudiandae unde vero voluptatibus. Magnam, repudiandae.
                                        </p>
                                        <span class="user-chat__status user-chat__status--offline">offline (2 minutes ago)</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    menu1
                </div>
                <div id="menu2" class="tab-pane fade">
                    menu2
                </div>
            </div>
        </div>

    </div>

    <div class="chat card ml-3 flex-grow-1 d-none">
        <p class="m-auto">Click on any chat to open it here</p>
    </div>

    <div class="chat card ml-3 flex-grow-1">
        <div class="chat-header card-header bg-white">
            <div class="chat-header__profile media align-items-center">
                <img class="chat-header__avatar shadow-sm mr-3" src="https://avatars.dicebear.com/api/avataaars/varun.svg?mood[]=happy" alt="">
                <div class="chat-header__name media-body">
                    <h4 class="mb-0">Varun Dhavan</h4>
                    <span class="text-success">online</span>
                </div>
            </div>

            <button type="button" class="close-btn ml-auto">
                <span class="fas fa-close"></span>
            </button>
        </div>

        <div class="card-body">
            <ul class="messages-list">
                <li class="messages-list__item">
                    <div class="message">
                        <img class="message__avatar shadow-sm mr-2" src="https://avatars.dicebear.com/api/avataaars/varun.svg?mood[]=happy" alt="">
                        <div class="message__body">
                            <div class="message__content">
                                <div class="message__author">
                                    Varun Dhavan
                                </div>
                                <div class="message__text">
                                    Салом
                                </div>
                            </div>
                            <div class="message__time mt-1">
                                19.06.2019 | 14:35
                            </div>
                        </div>
                    </div>
                </li>

                <li class="messages-list__item messages-list__item--mine">
                    <div class="message message--mine text-right">
                        <div class="message__body">
                            <div class="message__content">
                                <div class="message__text">
                                    Salom
                                </div>
                            </div>
                            <div class="message__time mt-1">
                                19.06.2019 | 14:37
                            </div>
                        </div>
                    </div>
                </li>

                <li class="messages-list__item">
                    <div class="message">
                        <img class="message__avatar shadow-sm mr-2" src="https://avatars.dicebear.com/api/avataaars/varun.svg?mood[]=happy" alt="">
                        <div class="message__body">
                            <div class="message__content">
                                <div class="message__author">
                                    Varun Dhavan
                                </div>
                                <div class="message__text">
                                    Имтихон вактлари аник болдими
                                </div>
                            </div>
                            <div class="message__time mt-1">
                                19.06.2019 | 14:35
                            </div>
                        </div>
                    </div>
                </li>

                <li class="messages-list__item messages-list__item--mine">
                    <div class="message message--mine text-right">
                        <div class="message__body">
                            <div class="message__content">
                                <div class="message__text">
                                    Ha
                                </div>
                            </div>
                            <div class="message__time mt-1">
                                19.06.2019 | 14:38
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="card-footer">
            <form class="message-form">
                <div class="input-group flex-nowrap">
                    <div class="input-group-prepend">
                        <span class="input-group-text fas fa-paper-plane"></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Текст" aria-label="Текст">
                    <div class="input-group-append">
                        <button class="message-form__send" type="submit"">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
