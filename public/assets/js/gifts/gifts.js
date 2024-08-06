/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 12);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/assets/js/gifts/gifts.js":
/*!********************************************!*\
  !*** ./resources/assets/js/gifts/gifts.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var tableName = "#giftsTable";
$(tableName).DataTable({
  scrollX: true,
  deferRender: true,
  scroller: true,
  processing: true,
  serverSide: true,
  order: [[0, "asc"]],
  ajax: {
    url: recordsURL
  },
  columnDefs: [{
    targets: [10],
    orderable: false,
    className: "text-center",
    width: "8%"
  }],
  columns: [{
    data: "id",
    name: "id"
  }, {
    data: "title",
    name: "title",
    width: "15%"
  }, {
    data: "image",
    name: "image",
    render: function render(name, display, row) {
      if (!row.image) return "";
      return "<img src='" + row.image + "' style='width:150px;'/>";
    }
  }, {
    data: "price",
    name: "price"
  }, {
    data: "quantity",
    name: "quantity"
  }, {
    data: "urbox_type_id",
    name: "urbox_type_id",
    render: function render(name, display, row) {
      if (!row.urbox_type_id) return "";
      return gift_types[row.urbox_type_id] ? gift_types[row.urbox_type_id] : "";
    }
  }, {
    data: "client_id",
    name: "client_id",
    render: function render(name, display, row) {
      if (!row.client_id) return "";
      return clients[row.client_id] ? clients[row.client_id] : "";
    }
  }, {
    data: "expired_time",
    name: "expired_time"
  }, {
    data: "urbox_id",
    name: "urbox_id"
  }, {
    data: "status",
    name: "status",
    render: function render(name, display, row) {
      if (!row.status) return "";
      return row.status == 1 ? "Hoạt động" : "Không hoạt động";
    }
  }, {
    data: function data(row) {
      var url = recordsURL + row.id;
      var data = [{
        id: row.id,
        url: url + "/edit"
      }];
      return prepareTemplateRender("#giftsTemplate", data);
    },
    name: "id"
  }]
});
$(document).on("click", ".delete-btn", function (event) {
  var recordId = $(event.currentTarget).data("id");
  deleteItem(recordsURL + recordId, tableName, "Gift");
});

/***/ }),

/***/ 12:
/*!**************************************************!*\
  !*** multi ./resources/assets/js/gifts/gifts.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Library/WebServer/Documents/laravel/crm/resources/assets/js/gifts/gifts.js */"./resources/assets/js/gifts/gifts.js");


/***/ })

/******/ });