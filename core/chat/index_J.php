<?php
/** @var ZView $this */

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;

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
  <div class="flex-shrink-0 card skeleton w-25">
    <div class="card-header skeleton-hide text-white">
      <h4 class="mb-0">Пользователи</h4>
      <ul class="nav nav-tabs mt-3 d-flex justify-content-between" role="tablist">
        <li class="nav-item">
          <a class="text-white tabs bg-transparent nav-link active font-small px-2 py-2" data-toggle="tab" href="#chat">Чат</a>
        </li>
        <li class="nav-item">
          <a class="text-white tabs bg-transparent nav-link font-small px-2 py-2" data-toggle="tab" href="#request">Приглашения</a>
        </li>
        <li class="nav-item">
          <a class="text-white tabs bg-transparent nav-link font-small px-2 py-2" data-toggle="tab" href="#contact">Контакты</a>
        </li>
      </ul>
    </div>

    <div class="tab-content p-0">
      <div id="chat" class="tab-pane fade active show in">
        <div class="card-body p-0">
          <ul id="users-list" class="users-list"></ul>
        </div>
      </div>
      <div id="request" class="tab-pane fade">
        <div class="card-body p-0">
          <ul id="requests" class="requests users-list">
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
      </div>


      <div id="contact" class="tab-pane fade">
        <div class="card-body p-0">
          <ul id="contacts" class="contacts users-list">
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
                  <button type="disabled" class="btn btn-outline-danger rounded-pill px-2 btn-sm">вы
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

  <div id="empty-chat" class="chat card skeleton ml-3 flex-grow-1">
    <p class="m-auto">Кликните на любой чат, чтобы открыть его здесь</p>
  </div>

  <div id="active-chat-area" class="chat card ml-3 flex-grow-1">
    <div class="chat-header card-header skeleton-hide bg-white">
      <div id="chat-header-profile" class="chat-header__profile media align-items-center">
        <img id="active-chat-avatar" class="chat-header__avatar shadow-sm mr-3"
             src="https://avatars.dicebear.com/api/avataaars/varun.svg?mood[]=happy" alt="">
        <div class="chat-header__name media-body">
          <h4 id="active-chat-name" class="mb-0">Загрузка</h4>
          <span id="active-chat-status" class="text-success">Загрузка</span>
        </div>
      </div>

      <button id="active-chat-close-btn" type="button" class="close-btn ml-auto">
        <span class="fas fa-close"></span>
      </button>
    </div>

    <div id="active-chat-empty-conversation-area" class="card-body">
      <p class="text-center">Нет сообщений</p>
    </div>

    <div id="active-chat-conversation-area" class="card-body">
      <ul id="active-chat-messages-list" class="messages-list"></ul>
    </div>

    <div class="card-footer">
      <form id="message-form" class="message-form" autocomplete="off">
        <div class="input-group flex-nowrap">
          <div class="input-group-prepend">
            <span class="input-group-text fas fa-paper-plane"></span>
          </div>
          <input id="message-input" type="text" class="form-control" placeholder="Текст" aria-label="Текст">
          <div class="input-group-append">
            <button id="message-send-btn" class="message-form__send" type="submit">Отправить</button>
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
        <h5 class="modal-title">Профиль</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="fas fa-times"></span>
        </button>
      </div>
      <div class="modal-body">
        <div class="testimonial-card">
          <div class="avatar mx-auto mt-0">
            <img id="user-profile-modal-avatar" class="rounded-circle"
                 src="https://i.stack.imgur.com/gBMMe.png?s=328&g=1" alt="">
          </div>

          <div class="card-body p-0">
            <h4 id="user-profile-modal-name" class="card-title pb-3 border-bottom">Загрузка</h4>
            <ul class="list-group list-group-flush">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Страна: <span id="user-profile-modal-country">Загрузка</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Роль: <span id="user-profile-modal-role">Загрузка</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="user-profile-modal-block-user-btn" type="button" class="btn btn-sm btn-danger rounded-pill">
          Заблокировать
        </button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous"></script>

<script>
window.chat = {
  me: Number('<?= $this->userIdentity()->id ?>'),
  port: Number('<?= $this->bootEnv('socketPort') ?>'),
};
</script>

<script src="/render/chates/eyuf-chat/scripts/Defaults.js"></script>
<script src="/render/chates/eyuf-chat/scripts/Utils.js"></script>
<script src="/render/chates/eyuf-chat/scripts/Messages.js"></script>
<script src="/render/chates/eyuf-chat/scripts/Statics.js"></script>
<script src="/render/chates/eyuf-chat/scripts/State.js"></script>
<script src="/render/chates/eyuf-chat/scripts/Templater.js"></script>
<script src="/render/chates/eyuf-chat/scripts/Renderer.js"></script>
<script src="/render/chates/eyuf-chat/scripts/index.js"></script>
