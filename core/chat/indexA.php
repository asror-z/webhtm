<?php
/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;

$action = new WebItem();

$action->title = Azl . 'Чат';
$action->icon = 'fal fa-print';
$action->loader = false;
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
            <ul class="nav nav-tabs d-flex justify-content-between">
                <li class="nav-item"><a class="text-white tabs bg-transparent nav-link active" data-toggle="tab"
                                        href="#chat">Чат</a></li>
                <li class="nav-item"><a class="text-white tabs bg-transparent nav-link" data-toggle="tab" href="#menu1">Приглашения</a>
                </li>
                <li class="nav-item"><a class="text-white tabs bg-transparent nav-link" data-toggle="tab" href="#menu2">Контакты</a>
                </li>
            </ul>
        </div>

        <div>

            <div class="tab-content p-0">
                <div id="chat" class="tab-pane fade active show in">
                    <div class="card-body p-0">
                        <ul class="users-list">
                            <li class="users-list__item">
                                <div class="user-chat user-chat--active media">
                                    <img class="user-chat__avatar shadow-sm mr-2"
                                         src="https://avatars.dicebear.com/api/avataaars/varun.svg?mood[]=happy" alt="">
                                    <div class="media-body">
                                        <h5 class="user-chat__name mb-0">Varun Dhavan</h5>
                                        <p class="user-chat__message user-chat__message--sent mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate
                                            delectus eos esse facilis fugit harum minima minus, perferendis perspiciatis
                                            praesentium quas quo recusandae repudiandae unde vero voluptatibus. Magnam,
                                            repudiandae.
                                        </p>
                                        <span class="user-chat__status user-chat__status--online">online</span>
                                    </div>
                                </div>
                            </li>

                            <li class="users-list__item">
                                <div class="user-chat media">
                                    <img class="user-chat__avatar shadow-sm mr-2"
                                         src="https://avatars.dicebear.com/api/avataaars/john.svg?mood[]=happy" alt="">
                                    <div class="user-chat__body media-body">
                                        <h5 class="user-chat__name mb-0">John Doe</h5>
                                        <p class="user-chat__message user-chat__message--sent mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate
                                            delectus eos esse facilis fugit harum minima minus, perferendis perspiciatis
                                            praesentium quas quo recusandae repudiandae unde vero voluptatibus. Magnam,
                                            repudiandae.
                                        </p>
                                        <span class="user-chat__status user-chat__status--online">online</span>
                                    </div>
                                </div>
                            </li>

                            <li class="users-list__item">
                                <div class="user-chat media">
                                    <img class="user-chat__avatar shadow-sm mr-2"
                                         src="https://avatars.dicebear.com/api/avataaars/jane.svg?mood[]=happy" alt="">
                                    <div class="user-chat__body media-body">
                                        <h5 class="user-chat__name mb-0">Jane Doe</h5>
                                        <p class="user-chat__message user-chat__message--sent mb-0">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum cupiditate
                                            delectus eos esse facilis fugit harum minima minus, perferendis perspiciatis
                                            praesentium quas quo recusandae repudiandae unde vero voluptatibus. Magnam,
                                            repudiandae.
                                        </p>
                                        <span class="user-chat__status user-chat__status--offline">offline (2 minutes ago)</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="menu1" class="tab-pane fade">
                    <ul class="users-list">
                        <li class="users-list__item">
                            <div class="user-chat media d-flex align-items-center">
                                <img class="user-chat__avatar shadow-sm mr-2"
                                     src="https://avatars.dicebear.com/api/avataaars/jane.svg?mood[]=happy" alt="">
                                <div class="user-chat__body media-body">
                                    <h5 class="user-chat__name mb-0">Jane Doe</h5>
                                </div>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary rounded-pill px-2 btn-sm">принят
                                    </button>
                                    <button type="button" class="btn btn-danger rounded-pill px-2 btn-sm">отклонить
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="menu2" class="tab-pane fade">
                    <ul class="users-list">
                        <li class="users-list__item">
                            <div class="user-chat media d-flex align-items-center">
                                <img class="user-chat__avatar shadow-sm mr-2"
                                     src="https://avatars.dicebear.com/api/avataaars/jane.svg?mood[]=happy" alt="">
                                <div class="user-chat__body media-body">
                                    <h5 class="user-chat__name mb-0">Jane Doe</h5>
                                </div>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary rounded-pill px-2 btn-sm">отправить
                                        приглашение
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="users-list__item">
                            <div class="user-chat media d-flex align-items-center">
                                <img class="user-chat__avatar shadow-sm mr-2"
                                     src="https://avatars.dicebear.com/api/avataaars/jane.svg?mood[]=happy" alt="">
                                <div class="user-chat__body media-body">
                                    <h5 class="user-chat__name mb-0">Anne Doe</h5>
                                </div>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-outline-primary rounded-pill px-2 btn-sm">
                                        отправлено
                                    </button>
                                </div>
                            </div>
                        </li>
                        <li class="users-list__item">
                            <div class="user-chat media d-flex align-items-center">
                                <img class="user-chat__avatar shadow-sm mr-2"
                                     src="https://avatars.dicebear.com/api/avataaars/jane.svg?mood[]=happy" alt="">
                                <div class="user-chat__body media-body">
                                    <h5 class="user-chat__name mb-0">Anne Doe</h5>
                                </div>
                                <div class="d-flex">
                                    <button type="disabled" class="btn btn-outline-danger rounded-pill px-2 btn-sm">вас
                                        заблокировал(а)
                                    </button>
                                </div>
                            </div>
                        </li>
                    </ul>
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
                <img class="chat-header__avatar shadow-sm mr-3"
                     src="https://avatars.dicebear.com/api/avataaars/varun.svg?mood[]=happy" alt="">
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
                        <img class="message__avatar shadow-sm mr-2"
                             src="https://avatars.dicebear.com/api/avataaars/varun.svg?mood[]=happy" alt="">
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
                        <img class="message__avatar shadow-sm mr-2"
                             src="https://avatars.dicebear.com/api/avataaars/varun.svg?mood[]=happy" alt="">
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
                        <button class="message-form__send" type="submit"
                        ">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="user-profile-modal" class="modal fade" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Профиль</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="fas fa-times"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="p-3">
                    <div class="card testimonial-card mt-2">
                        <!-- Background color -->
                        <div class="card-up indigo lighten-1"></div>

                        <!-- Avatar -->
                        <div class="avatar mx-auto white">
                            <img src="https://i.stack.imgur.com/gBMMe.png?s=328&g=1" class="rounded-circle"
                                 alt="woman avatar">
                        </div>
                        <!-- Content -->
                        <div class="card-body">
                            <!-- Name -->
                            <h4 class="card-title">Anna Doe</h4>
                            <hr>
                            <!-- Quotation -->
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center"> ОТМ:
                                    <span>TUIT</span></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Mutaxassisligi: <span>Kompyuter Injiner</span></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">таълим
                                    дастури: <span>Sirtqi</span></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    илмий-тадқиқот: <span>Doktorantura</span></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-prim ary rounded-pill">добавить в друзья</button>
                    <button type="button" class="btn btn-sm btn-danger rounded-pill">заблокировать</button>
            </div>
        </div>
    </div>
</div>
