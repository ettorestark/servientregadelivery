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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/settings.js":
/*!**********************************!*\
  !*** ./resources/js/settings.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  validateApikeys();
  $('#add_holliday').click(function () {
    var $div = $('div[id^="holidays-form0"]:last');
    var $divAfter = $('div[id^="holidays-form"]:last');
    var num = parseInt($divAfter.prop("id").match(/\d+/g), 10) + 1;
    var $clone = $div.clone();
    var selectDays = $clone.children().eq(0).children().eq(0);
    var selectMonths = $clone.children().eq(1).children().eq(0);
    var deleteButton = $clone.children().eq(2).children().eq(0);
    selectDays.prop('id', "days" + num);
    selectMonths.prop('id', "months" + num);
    selectDays.prop('name', "holidays[day][" + num + "]");
    selectMonths.prop('name', "holidays[month][" + num + "]");
    deleteButton.prop('id', num);
    $clone.prop('id', 'holidays-form' + num);
    $clone.css('display', 'block');
    $divAfter.after($clone);
  });
  $(document).on('click', '.remove_holiday', function () {
    var button_id = $(this).attr("id");
    $("#holidays-form" + button_id).remove();
  });
  $('.form-check input').on('change', function () {
    value = $('input[name=SETT_COST_TYPE]:checked').val();

    if (value == "Fixed") {
      $("#custom-cost").css("display", "block");
    } else {
      $("#custom-cost").css("display", "none");
    }

    if (value == "Percentage") {
      $("#custom-percentage").css("display", "block");
      $("#messagePercentage").css("display", "block");
    } else {
      $("#custom-percentage").css("display", "none");
      $("#messagePercentage").css("display", "none");
    }

    if (value == "Freefor") {
      $("#custom-Freefor").css("display", "block");
    } else {
      $("#custom-Freefor").css("display", "none");
    }
  });
  $('.api_information input').on('change', function () {
    validateApikeys();
  }); //Selecciona el valor del mes 

  $(document).on('change', '.holiday-month', function () {
    $id = parseInt($(this).attr("id").match(/\d+/g), 10);
    $selectedMonth = $(this).val();
    $days = daysInMonth($selectedMonth, 1965);
    anableOptions($days, $id);
  });
  $('#enableDobleTurn').on('change', function () {
    $display = $(".dobleTurn").css("display");

    if ($display == "none") {
      $(".dobleTurn").css("display", "flex");
    } else {
      $(".dobleTurn").css("display", "none");
    }
  });

  function daysInMonth(month, year) {
    return new Date(year, month, 0).getDate();
  } //Activa y desactiva las fechas


  function anableOptions($days, $id) {
    for ($i = 1; $i <= 31; $i++) {
      if ($i <= $days) {
        $("#days" + $id + " option[value=" + $i + "]").css('display', 'block');
      } else {
        $("#days" + $id + " option[value=" + $i + "]").css('display', 'none');
      }
    }
  }

  function validateApikeys() {
    $apiKey = $('input[name=SETT_SERVIENTREGA_API]').val();
    $apiSecret = $('input[name=SETT_SERVIENTREGA_SECRET]').val();

    if ($apiKey.length > 1 && $apiSecret.length > 5) {
      $("#btn-test-conexion").removeAttr('disabled');
    } else {
      $('#btn-test-conexion').attr('disabled', 'disabled');
    }
  }
});

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/js/settings.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/joseph/Sites/shopify-servientrega/resources/js/settings.js */"./resources/js/settings.js");


/***/ })

/******/ });