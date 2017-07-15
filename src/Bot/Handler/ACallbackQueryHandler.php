<?php

declare(strict_types = 1);

namespace Telegram\Bot\Handler;

use Telegram\Bot\ABot;
use Telegram\API;
use Telegram\API\Method\{SendMessage, EditMessageReplyMarkup};
use Telegram\API\Type\CallbackQuery;

abstract class ACallbackQueryHandler extends \Telegram\Bot\AHandler {

    /**
     * @var \Telegram\API\Type\CallbackQuery
     */
    protected $_callbackQuery = NULL;

    /**
     * @inheritdoc
     */
    public function __construct(API\Type\Update $update, ABot $bot) {
        parent::__construct($update, $bot);
        $this->_callbackQuery = $update->callbackQuery;
    }

    /**
     * Easy method used to remove an inlineKeyboard from the originating message
     */
    protected function _removeInlineKeyboard() {
        if (isset($this->_callbackQuery->message)) {
            $removeInlineKeyboard = new EditMessageReplyMarkup;
            $removeInlineKeyboard->chatId = $this->_callbackQuery->message->chat->id;
            $removeInlineKeyboard->messageId = $this->_callbackQuery->message->id;
            $removeInlineKeyboard->call($this->_apiBot);
        }
    }
}
