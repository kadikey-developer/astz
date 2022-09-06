/*!
  * Bootstrap tab.js v4.6.1 (https://getbootstrap.com/)
  * Copyright 2011-2022 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
  */
(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory(require('jquery'), require('./util.js')) :
  typeof define === 'function' && define.amd ? define(['jquery', './util'], factory) :
  (global = typeof globalThis !== 'undefined' ? globalThis : global || self, global.Tab = factory(global.jQuery, global.Util));
})(this, (function ($, Util) { 'use strict';

  function _interopDefaultLegacy (e) { return e && typeof e === 'object' && 'default' in e ? e : { 'default': e }; }

  var $__default = /*#__PURE__*/_interopDefaultLegacy($);
  var Util__default = /*#__PURE__*/_interopDefaultLegacy(Util);

  function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i];
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
    }
  }

  function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
  }

  function cov_f03z6lr7t() {
    var path = "D:\\layouts\\astz-layout\\app\\lib\\bootstrap-4.6.1\\js\\src\\tab.js";
    var hash = "fcf268f05174eedca503fd8f590b5ae5d81329a5";
    var global = new Function("return this")();
    var gcv = "__coverage__";
    var coverageData = {
      path: "D:\\layouts\\astz-layout\\app\\lib\\bootstrap-4.6.1\\js\\src\\tab.js",
      statementMap: {
        "0": {
          start: {
            line: 15,
            column: 13
          },
          end: {
            line: 15,
            column: 18
          }
        },
        "1": {
          start: {
            line: 16,
            column: 16
          },
          end: {
            line: 16,
            column: 23
          }
        },
        "2": {
          start: {
            line: 17,
            column: 17
          },
          end: {
            line: 17,
            column: 25
          }
        },
        "3": {
          start: {
            line: 18,
            column: 18
          },
          end: {
            line: 18,
            column: 32
          }
        },
        "4": {
          start: {
            line: 19,
            column: 21
          },
          end: {
            line: 19,
            column: 32
          }
        },
        "5": {
          start: {
            line: 20,
            column: 27
          },
          end: {
            line: 20,
            column: 37
          }
        },
        "6": {
          start: {
            line: 22,
            column: 33
          },
          end: {
            line: 22,
            column: 48
          }
        },
        "7": {
          start: {
            line: 23,
            column: 26
          },
          end: {
            line: 23,
            column: 34
          }
        },
        "8": {
          start: {
            line: 24,
            column: 28
          },
          end: {
            line: 24,
            column: 38
          }
        },
        "9": {
          start: {
            line: 25,
            column: 24
          },
          end: {
            line: 25,
            column: 30
          }
        },
        "10": {
          start: {
            line: 26,
            column: 24
          },
          end: {
            line: 26,
            column: 30
          }
        },
        "11": {
          start: {
            line: 28,
            column: 19
          },
          end: {
            line: 28,
            column: 37
          }
        },
        "12": {
          start: {
            line: 29,
            column: 21
          },
          end: {
            line: 29,
            column: 41
          }
        },
        "13": {
          start: {
            line: 30,
            column: 19
          },
          end: {
            line: 30,
            column: 37
          }
        },
        "14": {
          start: {
            line: 31,
            column: 20
          },
          end: {
            line: 31,
            column: 39
          }
        },
        "15": {
          start: {
            line: 32,
            column: 29
          },
          end: {
            line: 32,
            column: 63
          }
        },
        "16": {
          start: {
            line: 34,
            column: 26
          },
          end: {
            line: 34,
            column: 37
          }
        },
        "17": {
          start: {
            line: 35,
            column: 32
          },
          end: {
            line: 35,
            column: 51
          }
        },
        "18": {
          start: {
            line: 36,
            column: 24
          },
          end: {
            line: 36,
            column: 33
          }
        },
        "19": {
          start: {
            line: 37,
            column: 27
          },
          end: {
            line: 37,
            column: 43
          }
        },
        "20": {
          start: {
            line: 38,
            column: 29
          },
          end: {
            line: 38,
            column: 94
          }
        },
        "21": {
          start: {
            line: 39,
            column: 33
          },
          end: {
            line: 39,
            column: 51
          }
        },
        "22": {
          start: {
            line: 40,
            column: 39
          },
          end: {
            line: 40,
            column: 65
          }
        },
        "23": {
          start: {
            line: 48,
            column: 4
          },
          end: {
            line: 48,
            column: 27
          }
        },
        "24": {
          start: {
            line: 53,
            column: 4
          },
          end: {
            line: 53,
            column: 18
          }
        },
        "25": {
          start: {
            line: 58,
            column: 4
          },
          end: {
            line: 63,
            column: 5
          }
        },
        "26": {
          start: {
            line: 62,
            column: 6
          },
          end: {
            line: 62,
            column: 12
          }
        },
        "27": {
          start: {
            line: 67,
            column: 24
          },
          end: {
            line: 67,
            column: 76
          }
        },
        "28": {
          start: {
            line: 68,
            column: 21
          },
          end: {
            line: 68,
            column: 63
          }
        },
        "29": {
          start: {
            line: 70,
            column: 4
          },
          end: {
            line: 74,
            column: 5
          }
        },
        "30": {
          start: {
            line: 71,
            column: 27
          },
          end: {
            line: 71,
            column: 128
          }
        },
        "31": {
          start: {
            line: 72,
            column: 6
          },
          end: {
            line: 72,
            column: 63
          }
        },
        "32": {
          start: {
            line: 73,
            column: 6
          },
          end: {
            line: 73,
            column: 46
          }
        },
        "33": {
          start: {
            line: 76,
            column: 22
          },
          end: {
            line: 78,
            column: 6
          }
        },
        "34": {
          start: {
            line: 80,
            column: 22
          },
          end: {
            line: 82,
            column: 6
          }
        },
        "35": {
          start: {
            line: 84,
            column: 4
          },
          end: {
            line: 86,
            column: 5
          }
        },
        "36": {
          start: {
            line: 85,
            column: 6
          },
          end: {
            line: 85,
            column: 36
          }
        },
        "37": {
          start: {
            line: 88,
            column: 4
          },
          end: {
            line: 88,
            column: 39
          }
        },
        "38": {
          start: {
            line: 90,
            column: 4
          },
          end: {
            line: 93,
            column: 5
          }
        },
        "39": {
          start: {
            line: 92,
            column: 6
          },
          end: {
            line: 92,
            column: 12
          }
        },
        "40": {
          start: {
            line: 95,
            column: 4
          },
          end: {
            line: 97,
            column: 5
          }
        },
        "41": {
          start: {
            line: 96,
            column: 6
          },
          end: {
            line: 96,
            column: 47
          }
        },
        "42": {
          start: {
            line: 99,
            column: 4
          },
          end: {
            line: 102,
            column: 5
          }
        },
        "43": {
          start: {
            line: 104,
            column: 21
          },
          end: {
            line: 115,
            column: 5
          }
        },
        "44": {
          start: {
            line: 105,
            column: 26
          },
          end: {
            line: 107,
            column: 8
          }
        },
        "45": {
          start: {
            line: 109,
            column: 25
          },
          end: {
            line: 111,
            column: 8
          }
        },
        "46": {
          start: {
            line: 113,
            column: 6
          },
          end: {
            line: 113,
            column: 38
          }
        },
        "47": {
          start: {
            line: 114,
            column: 6
          },
          end: {
            line: 114,
            column: 42
          }
        },
        "48": {
          start: {
            line: 117,
            column: 4
          },
          end: {
            line: 121,
            column: 5
          }
        },
        "49": {
          start: {
            line: 118,
            column: 6
          },
          end: {
            line: 118,
            column: 57
          }
        },
        "50": {
          start: {
            line: 120,
            column: 6
          },
          end: {
            line: 120,
            column: 16
          }
        },
        "51": {
          start: {
            line: 125,
            column: 4
          },
          end: {
            line: 125,
            column: 41
          }
        },
        "52": {
          start: {
            line: 126,
            column: 4
          },
          end: {
            line: 126,
            column: 24
          }
        },
        "53": {
          start: {
            line: 131,
            column: 27
          },
          end: {
            line: 133,
            column: 44
          }
        },
        "54": {
          start: {
            line: 135,
            column: 19
          },
          end: {
            line: 135,
            column: 36
          }
        },
        "55": {
          start: {
            line: 136,
            column: 28
          },
          end: {
            line: 136,
            column: 87
          }
        },
        "56": {
          start: {
            line: 137,
            column: 21
          },
          end: {
            line: 141,
            column: 5
          }
        },
        "57": {
          start: {
            line: 137,
            column: 27
          },
          end: {
            line: 141,
            column: 5
          }
        },
        "58": {
          start: {
            line: 143,
            column: 4
          },
          end: {
            line: 152,
            column: 5
          }
        },
        "59": {
          start: {
            line: 144,
            column: 33
          },
          end: {
            line: 144,
            column: 78
          }
        },
        "60": {
          start: {
            line: 146,
            column: 6
          },
          end: {
            line: 149,
            column: 49
          }
        },
        "61": {
          start: {
            line: 151,
            column: 6
          },
          end: {
            line: 151,
            column: 16
          }
        },
        "62": {
          start: {
            line: 156,
            column: 4
          },
          end: {
            line: 170,
            column: 5
          }
        },
        "63": {
          start: {
            line: 157,
            column: 6
          },
          end: {
            line: 157,
            column: 46
          }
        },
        "64": {
          start: {
            line: 159,
            column: 28
          },
          end: {
            line: 161,
            column: 10
          }
        },
        "65": {
          start: {
            line: 163,
            column: 6
          },
          end: {
            line: 165,
            column: 7
          }
        },
        "66": {
          start: {
            line: 164,
            column: 8
          },
          end: {
            line: 164,
            column: 55
          }
        },
        "67": {
          start: {
            line: 167,
            column: 6
          },
          end: {
            line: 169,
            column: 7
          }
        },
        "68": {
          start: {
            line: 168,
            column: 8
          },
          end: {
            line: 168,
            column: 51
          }
        },
        "69": {
          start: {
            line: 172,
            column: 4
          },
          end: {
            line: 172,
            column: 42
          }
        },
        "70": {
          start: {
            line: 173,
            column: 4
          },
          end: {
            line: 175,
            column: 5
          }
        },
        "71": {
          start: {
            line: 174,
            column: 6
          },
          end: {
            line: 174,
            column: 49
          }
        },
        "72": {
          start: {
            line: 177,
            column: 4
          },
          end: {
            line: 177,
            column: 24
          }
        },
        "73": {
          start: {
            line: 179,
            column: 4
          },
          end: {
            line: 181,
            column: 5
          }
        },
        "74": {
          start: {
            line: 180,
            column: 6
          },
          end: {
            line: 180,
            column: 44
          }
        },
        "75": {
          start: {
            line: 183,
            column: 17
          },
          end: {
            line: 183,
            column: 35
          }
        },
        "76": {
          start: {
            line: 184,
            column: 4
          },
          end: {
            line: 186,
            column: 5
          }
        },
        "77": {
          start: {
            line: 185,
            column: 6
          },
          end: {
            line: 185,
            column: 32
          }
        },
        "78": {
          start: {
            line: 188,
            column: 4
          },
          end: {
            line: 198,
            column: 5
          }
        },
        "79": {
          start: {
            line: 189,
            column: 30
          },
          end: {
            line: 189,
            column: 70
          }
        },
        "80": {
          start: {
            line: 191,
            column: 6
          },
          end: {
            line: 195,
            column: 7
          }
        },
        "81": {
          start: {
            line: 192,
            column: 35
          },
          end: {
            line: 192,
            column: 108
          }
        },
        "82": {
          start: {
            line: 194,
            column: 8
          },
          end: {
            line: 194,
            column: 57
          }
        },
        "83": {
          start: {
            line: 197,
            column: 6
          },
          end: {
            line: 197,
            column: 49
          }
        },
        "84": {
          start: {
            line: 200,
            column: 4
          },
          end: {
            line: 202,
            column: 5
          }
        },
        "85": {
          start: {
            line: 201,
            column: 6
          },
          end: {
            line: 201,
            column: 16
          }
        },
        "86": {
          start: {
            line: 207,
            column: 4
          },
          end: {
            line: 223,
            column: 6
          }
        },
        "87": {
          start: {
            line: 208,
            column: 20
          },
          end: {
            line: 208,
            column: 27
          }
        },
        "88": {
          start: {
            line: 209,
            column: 17
          },
          end: {
            line: 209,
            column: 37
          }
        },
        "89": {
          start: {
            line: 211,
            column: 6
          },
          end: {
            line: 214,
            column: 7
          }
        },
        "90": {
          start: {
            line: 212,
            column: 8
          },
          end: {
            line: 212,
            column: 28
          }
        },
        "91": {
          start: {
            line: 213,
            column: 8
          },
          end: {
            line: 213,
            column: 34
          }
        },
        "92": {
          start: {
            line: 216,
            column: 6
          },
          end: {
            line: 222,
            column: 7
          }
        },
        "93": {
          start: {
            line: 217,
            column: 8
          },
          end: {
            line: 219,
            column: 9
          }
        },
        "94": {
          start: {
            line: 218,
            column: 10
          },
          end: {
            line: 218,
            column: 60
          }
        },
        "95": {
          start: {
            line: 221,
            column: 8
          },
          end: {
            line: 221,
            column: 22
          }
        },
        "96": {
          start: {
            line: 231,
            column: 0
          },
          end: {
            line: 235,
            column: 4
          }
        },
        "97": {
          start: {
            line: 233,
            column: 4
          },
          end: {
            line: 233,
            column: 26
          }
        },
        "98": {
          start: {
            line: 234,
            column: 4
          },
          end: {
            line: 234,
            column: 46
          }
        },
        "99": {
          start: {
            line: 241,
            column: 0
          },
          end: {
            line: 241,
            column: 33
          }
        },
        "100": {
          start: {
            line: 242,
            column: 0
          },
          end: {
            line: 242,
            column: 28
          }
        },
        "101": {
          start: {
            line: 243,
            column: 0
          },
          end: {
            line: 246,
            column: 1
          }
        },
        "102": {
          start: {
            line: 244,
            column: 2
          },
          end: {
            line: 244,
            column: 33
          }
        },
        "103": {
          start: {
            line: 245,
            column: 2
          },
          end: {
            line: 245,
            column: 29
          }
        }
      },
      fnMap: {
        "0": {
          name: "(anonymous_0)",
          decl: {
            start: {
              line: 47,
              column: 2
            },
            end: {
              line: 47,
              column: 3
            }
          },
          loc: {
            start: {
              line: 47,
              column: 23
            },
            end: {
              line: 49,
              column: 3
            }
          },
          line: 47
        },
        "1": {
          name: "(anonymous_1)",
          decl: {
            start: {
              line: 52,
              column: 2
            },
            end: {
              line: 52,
              column: 3
            }
          },
          loc: {
            start: {
              line: 52,
              column: 23
            },
            end: {
              line: 54,
              column: 3
            }
          },
          line: 52
        },
        "2": {
          name: "(anonymous_2)",
          decl: {
            start: {
              line: 57,
              column: 2
            },
            end: {
              line: 57,
              column: 3
            }
          },
          loc: {
            start: {
              line: 57,
              column: 9
            },
            end: {
              line: 122,
              column: 3
            }
          },
          line: 57
        },
        "3": {
          name: "(anonymous_3)",
          decl: {
            start: {
              line: 104,
              column: 21
            },
            end: {
              line: 104,
              column: 22
            }
          },
          loc: {
            start: {
              line: 104,
              column: 27
            },
            end: {
              line: 115,
              column: 5
            }
          },
          line: 104
        },
        "4": {
          name: "(anonymous_4)",
          decl: {
            start: {
              line: 124,
              column: 2
            },
            end: {
              line: 124,
              column: 3
            }
          },
          loc: {
            start: {
              line: 124,
              column: 12
            },
            end: {
              line: 127,
              column: 3
            }
          },
          line: 124
        },
        "5": {
          name: "(anonymous_5)",
          decl: {
            start: {
              line: 130,
              column: 2
            },
            end: {
              line: 130,
              column: 3
            }
          },
          loc: {
            start: {
              line: 130,
              column: 42
            },
            end: {
              line: 153,
              column: 3
            }
          },
          line: 130
        },
        "6": {
          name: "(anonymous_6)",
          decl: {
            start: {
              line: 137,
              column: 21
            },
            end: {
              line: 137,
              column: 22
            }
          },
          loc: {
            start: {
              line: 137,
              column: 27
            },
            end: {
              line: 141,
              column: 5
            }
          },
          line: 137
        },
        "7": {
          name: "(anonymous_7)",
          decl: {
            start: {
              line: 155,
              column: 2
            },
            end: {
              line: 155,
              column: 3
            }
          },
          loc: {
            start: {
              line: 155,
              column: 49
            },
            end: {
              line: 203,
              column: 3
            }
          },
          line: 155
        },
        "8": {
          name: "(anonymous_8)",
          decl: {
            start: {
              line: 206,
              column: 2
            },
            end: {
              line: 206,
              column: 3
            }
          },
          loc: {
            start: {
              line: 206,
              column: 34
            },
            end: {
              line: 224,
              column: 3
            }
          },
          line: 206
        },
        "9": {
          name: "(anonymous_9)",
          decl: {
            start: {
              line: 207,
              column: 21
            },
            end: {
              line: 207,
              column: 22
            }
          },
          loc: {
            start: {
              line: 207,
              column: 33
            },
            end: {
              line: 223,
              column: 5
            }
          },
          line: 207
        },
        "10": {
          name: "(anonymous_10)",
          decl: {
            start: {
              line: 232,
              column: 50
            },
            end: {
              line: 232,
              column: 51
            }
          },
          loc: {
            start: {
              line: 232,
              column: 67
            },
            end: {
              line: 235,
              column: 3
            }
          },
          line: 232
        },
        "11": {
          name: "(anonymous_11)",
          decl: {
            start: {
              line: 243,
              column: 24
            },
            end: {
              line: 243,
              column: 25
            }
          },
          loc: {
            start: {
              line: 243,
              column: 30
            },
            end: {
              line: 246,
              column: 1
            }
          },
          line: 243
        }
      },
      branchMap: {
        "0": {
          loc: {
            start: {
              line: 58,
              column: 4
            },
            end: {
              line: 63,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 58,
              column: 4
            },
            end: {
              line: 63,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 58
        },
        "1": {
          loc: {
            start: {
              line: 58,
              column: 8
            },
            end: {
              line: 61,
              column: 54
            }
          },
          type: "binary-expr",
          locations: [{
            start: {
              line: 58,
              column: 8
            },
            end: {
              line: 58,
              column: 32
            }
          }, {
            start: {
              line: 59,
              column: 8
            },
            end: {
              line: 59,
              column: 63
            }
          }, {
            start: {
              line: 60,
              column: 8
            },
            end: {
              line: 60,
              column: 52
            }
          }, {
            start: {
              line: 61,
              column: 8
            },
            end: {
              line: 61,
              column: 54
            }
          }],
          line: 58
        },
        "2": {
          loc: {
            start: {
              line: 70,
              column: 4
            },
            end: {
              line: 74,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 70,
              column: 4
            },
            end: {
              line: 74,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 70
        },
        "3": {
          loc: {
            start: {
              line: 71,
              column: 27
            },
            end: {
              line: 71,
              column: 128
            }
          },
          type: "cond-expr",
          locations: [{
            start: {
              line: 71,
              column: 92
            },
            end: {
              line: 71,
              column: 110
            }
          }, {
            start: {
              line: 71,
              column: 113
            },
            end: {
              line: 71,
              column: 128
            }
          }],
          line: 71
        },
        "4": {
          loc: {
            start: {
              line: 71,
              column: 27
            },
            end: {
              line: 71,
              column: 89
            }
          },
          type: "binary-expr",
          locations: [{
            start: {
              line: 71,
              column: 27
            },
            end: {
              line: 71,
              column: 56
            }
          }, {
            start: {
              line: 71,
              column: 60
            },
            end: {
              line: 71,
              column: 89
            }
          }],
          line: 71
        },
        "5": {
          loc: {
            start: {
              line: 84,
              column: 4
            },
            end: {
              line: 86,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 84,
              column: 4
            },
            end: {
              line: 86,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 84
        },
        "6": {
          loc: {
            start: {
              line: 90,
              column: 4
            },
            end: {
              line: 93,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 90,
              column: 4
            },
            end: {
              line: 93,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 90
        },
        "7": {
          loc: {
            start: {
              line: 90,
              column: 8
            },
            end: {
              line: 91,
              column: 38
            }
          },
          type: "binary-expr",
          locations: [{
            start: {
              line: 90,
              column: 8
            },
            end: {
              line: 90,
              column: 38
            }
          }, {
            start: {
              line: 91,
              column: 8
            },
            end: {
              line: 91,
              column: 38
            }
          }],
          line: 90
        },
        "8": {
          loc: {
            start: {
              line: 95,
              column: 4
            },
            end: {
              line: 97,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 95,
              column: 4
            },
            end: {
              line: 97,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 95
        },
        "9": {
          loc: {
            start: {
              line: 117,
              column: 4
            },
            end: {
              line: 121,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 117,
              column: 4
            },
            end: {
              line: 121,
              column: 5
            }
          }, {
            start: {
              line: 119,
              column: 11
            },
            end: {
              line: 121,
              column: 5
            }
          }],
          line: 117
        },
        "10": {
          loc: {
            start: {
              line: 131,
              column: 27
            },
            end: {
              line: 133,
              column: 44
            }
          },
          type: "cond-expr",
          locations: [{
            start: {
              line: 132,
              column: 6
            },
            end: {
              line: 132,
              column: 43
            }
          }, {
            start: {
              line: 133,
              column: 6
            },
            end: {
              line: 133,
              column: 44
            }
          }],
          line: 131
        },
        "11": {
          loc: {
            start: {
              line: 131,
              column: 27
            },
            end: {
              line: 131,
              column: 100
            }
          },
          type: "binary-expr",
          locations: [{
            start: {
              line: 131,
              column: 27
            },
            end: {
              line: 131,
              column: 36
            }
          }, {
            start: {
              line: 131,
              column: 41
            },
            end: {
              line: 131,
              column: 68
            }
          }, {
            start: {
              line: 131,
              column: 72
            },
            end: {
              line: 131,
              column: 99
            }
          }],
          line: 131
        },
        "12": {
          loc: {
            start: {
              line: 136,
              column: 28
            },
            end: {
              line: 136,
              column: 87
            }
          },
          type: "binary-expr",
          locations: [{
            start: {
              line: 136,
              column: 28
            },
            end: {
              line: 136,
              column: 36
            }
          }, {
            start: {
              line: 136,
              column: 41
            },
            end: {
              line: 136,
              column: 47
            }
          }, {
            start: {
              line: 136,
              column: 51
            },
            end: {
              line: 136,
              column: 86
            }
          }],
          line: 136
        },
        "13": {
          loc: {
            start: {
              line: 143,
              column: 4
            },
            end: {
              line: 152,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 143,
              column: 4
            },
            end: {
              line: 152,
              column: 5
            }
          }, {
            start: {
              line: 150,
              column: 11
            },
            end: {
              line: 152,
              column: 5
            }
          }],
          line: 143
        },
        "14": {
          loc: {
            start: {
              line: 143,
              column: 8
            },
            end: {
              line: 143,
              column: 33
            }
          },
          type: "binary-expr",
          locations: [{
            start: {
              line: 143,
              column: 8
            },
            end: {
              line: 143,
              column: 14
            }
          }, {
            start: {
              line: 143,
              column: 18
            },
            end: {
              line: 143,
              column: 33
            }
          }],
          line: 143
        },
        "15": {
          loc: {
            start: {
              line: 156,
              column: 4
            },
            end: {
              line: 170,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 156,
              column: 4
            },
            end: {
              line: 170,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 156
        },
        "16": {
          loc: {
            start: {
              line: 163,
              column: 6
            },
            end: {
              line: 165,
              column: 7
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 163,
              column: 6
            },
            end: {
              line: 165,
              column: 7
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 163
        },
        "17": {
          loc: {
            start: {
              line: 167,
              column: 6
            },
            end: {
              line: 169,
              column: 7
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 167,
              column: 6
            },
            end: {
              line: 169,
              column: 7
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 167
        },
        "18": {
          loc: {
            start: {
              line: 173,
              column: 4
            },
            end: {
              line: 175,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 173,
              column: 4
            },
            end: {
              line: 175,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 173
        },
        "19": {
          loc: {
            start: {
              line: 179,
              column: 4
            },
            end: {
              line: 181,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 179,
              column: 4
            },
            end: {
              line: 181,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 179
        },
        "20": {
          loc: {
            start: {
              line: 184,
              column: 4
            },
            end: {
              line: 186,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 184,
              column: 4
            },
            end: {
              line: 186,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 184
        },
        "21": {
          loc: {
            start: {
              line: 184,
              column: 8
            },
            end: {
              line: 184,
              column: 42
            }
          },
          type: "binary-expr",
          locations: [{
            start: {
              line: 184,
              column: 8
            },
            end: {
              line: 184,
              column: 14
            }
          }, {
            start: {
              line: 184,
              column: 18
            },
            end: {
              line: 184,
              column: 42
            }
          }],
          line: 184
        },
        "22": {
          loc: {
            start: {
              line: 188,
              column: 4
            },
            end: {
              line: 198,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 188,
              column: 4
            },
            end: {
              line: 198,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 188
        },
        "23": {
          loc: {
            start: {
              line: 188,
              column: 8
            },
            end: {
              line: 188,
              column: 62
            }
          },
          type: "binary-expr",
          locations: [{
            start: {
              line: 188,
              column: 8
            },
            end: {
              line: 188,
              column: 14
            }
          }, {
            start: {
              line: 188,
              column: 18
            },
            end: {
              line: 188,
              column: 62
            }
          }],
          line: 188
        },
        "24": {
          loc: {
            start: {
              line: 191,
              column: 6
            },
            end: {
              line: 195,
              column: 7
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 191,
              column: 6
            },
            end: {
              line: 195,
              column: 7
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 191
        },
        "25": {
          loc: {
            start: {
              line: 200,
              column: 4
            },
            end: {
              line: 202,
              column: 5
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 200,
              column: 4
            },
            end: {
              line: 202,
              column: 5
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 200
        },
        "26": {
          loc: {
            start: {
              line: 211,
              column: 6
            },
            end: {
              line: 214,
              column: 7
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 211,
              column: 6
            },
            end: {
              line: 214,
              column: 7
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 211
        },
        "27": {
          loc: {
            start: {
              line: 216,
              column: 6
            },
            end: {
              line: 222,
              column: 7
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 216,
              column: 6
            },
            end: {
              line: 222,
              column: 7
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 216
        },
        "28": {
          loc: {
            start: {
              line: 217,
              column: 8
            },
            end: {
              line: 219,
              column: 9
            }
          },
          type: "if",
          locations: [{
            start: {
              line: 217,
              column: 8
            },
            end: {
              line: 219,
              column: 9
            }
          }, {
            start: {
              line: undefined,
              column: undefined
            },
            end: {
              line: undefined,
              column: undefined
            }
          }],
          line: 217
        }
      },
      s: {
        "0": 0,
        "1": 0,
        "2": 0,
        "3": 0,
        "4": 0,
        "5": 0,
        "6": 0,
        "7": 0,
        "8": 0,
        "9": 0,
        "10": 0,
        "11": 0,
        "12": 0,
        "13": 0,
        "14": 0,
        "15": 0,
        "16": 0,
        "17": 0,
        "18": 0,
        "19": 0,
        "20": 0,
        "21": 0,
        "22": 0,
        "23": 0,
        "24": 0,
        "25": 0,
        "26": 0,
        "27": 0,
        "28": 0,
        "29": 0,
        "30": 0,
        "31": 0,
        "32": 0,
        "33": 0,
        "34": 0,
        "35": 0,
        "36": 0,
        "37": 0,
        "38": 0,
        "39": 0,
        "40": 0,
        "41": 0,
        "42": 0,
        "43": 0,
        "44": 0,
        "45": 0,
        "46": 0,
        "47": 0,
        "48": 0,
        "49": 0,
        "50": 0,
        "51": 0,
        "52": 0,
        "53": 0,
        "54": 0,
        "55": 0,
        "56": 0,
        "57": 0,
        "58": 0,
        "59": 0,
        "60": 0,
        "61": 0,
        "62": 0,
        "63": 0,
        "64": 0,
        "65": 0,
        "66": 0,
        "67": 0,
        "68": 0,
        "69": 0,
        "70": 0,
        "71": 0,
        "72": 0,
        "73": 0,
        "74": 0,
        "75": 0,
        "76": 0,
        "77": 0,
        "78": 0,
        "79": 0,
        "80": 0,
        "81": 0,
        "82": 0,
        "83": 0,
        "84": 0,
        "85": 0,
        "86": 0,
        "87": 0,
        "88": 0,
        "89": 0,
        "90": 0,
        "91": 0,
        "92": 0,
        "93": 0,
        "94": 0,
        "95": 0,
        "96": 0,
        "97": 0,
        "98": 0,
        "99": 0,
        "100": 0,
        "101": 0,
        "102": 0,
        "103": 0
      },
      f: {
        "0": 0,
        "1": 0,
        "2": 0,
        "3": 0,
        "4": 0,
        "5": 0,
        "6": 0,
        "7": 0,
        "8": 0,
        "9": 0,
        "10": 0,
        "11": 0
      },
      b: {
        "0": [0, 0],
        "1": [0, 0, 0, 0],
        "2": [0, 0],
        "3": [0, 0],
        "4": [0, 0],
        "5": [0, 0],
        "6": [0, 0],
        "7": [0, 0],
        "8": [0, 0],
        "9": [0, 0],
        "10": [0, 0],
        "11": [0, 0, 0],
        "12": [0, 0, 0],
        "13": [0, 0],
        "14": [0, 0],
        "15": [0, 0],
        "16": [0, 0],
        "17": [0, 0],
        "18": [0, 0],
        "19": [0, 0],
        "20": [0, 0],
        "21": [0, 0],
        "22": [0, 0],
        "23": [0, 0],
        "24": [0, 0],
        "25": [0, 0],
        "26": [0, 0],
        "27": [0, 0],
        "28": [0, 0]
      },
      _coverageSchema: "1a1c01bbd47fc00a2c39e90264f33305004495a9",
      hash: "fcf268f05174eedca503fd8f590b5ae5d81329a5"
    };
    var coverage = global[gcv] || (global[gcv] = {});

    if (!coverage[path] || coverage[path].hash !== hash) {
      coverage[path] = coverageData;
    }

    var actualCoverage = coverage[path];
    {
      // @ts-ignore
      cov_f03z6lr7t = function () {
        return actualCoverage;
      };
    }
    return actualCoverage;
  }

  cov_f03z6lr7t();
  /**
   * Constants
   */

  var NAME = (cov_f03z6lr7t().s[0]++, 'tab');
  var VERSION = (cov_f03z6lr7t().s[1]++, '4.6.1');
  var DATA_KEY = (cov_f03z6lr7t().s[2]++, 'bs.tab');
  var EVENT_KEY = (cov_f03z6lr7t().s[3]++, "." + DATA_KEY);
  var DATA_API_KEY = (cov_f03z6lr7t().s[4]++, '.data-api');
  var JQUERY_NO_CONFLICT = (cov_f03z6lr7t().s[5]++, $__default["default"].fn[NAME]);
  var CLASS_NAME_DROPDOWN_MENU = (cov_f03z6lr7t().s[6]++, 'dropdown-menu');
  var CLASS_NAME_ACTIVE = (cov_f03z6lr7t().s[7]++, 'active');
  var CLASS_NAME_DISABLED = (cov_f03z6lr7t().s[8]++, 'disabled');
  var CLASS_NAME_FADE = (cov_f03z6lr7t().s[9]++, 'fade');
  var CLASS_NAME_SHOW = (cov_f03z6lr7t().s[10]++, 'show');
  var EVENT_HIDE = (cov_f03z6lr7t().s[11]++, "hide" + EVENT_KEY);
  var EVENT_HIDDEN = (cov_f03z6lr7t().s[12]++, "hidden" + EVENT_KEY);
  var EVENT_SHOW = (cov_f03z6lr7t().s[13]++, "show" + EVENT_KEY);
  var EVENT_SHOWN = (cov_f03z6lr7t().s[14]++, "shown" + EVENT_KEY);
  var EVENT_CLICK_DATA_API = (cov_f03z6lr7t().s[15]++, "click" + EVENT_KEY + DATA_API_KEY);
  var SELECTOR_DROPDOWN = (cov_f03z6lr7t().s[16]++, '.dropdown');
  var SELECTOR_NAV_LIST_GROUP = (cov_f03z6lr7t().s[17]++, '.nav, .list-group');
  var SELECTOR_ACTIVE = (cov_f03z6lr7t().s[18]++, '.active');
  var SELECTOR_ACTIVE_UL = (cov_f03z6lr7t().s[19]++, '> li > .active');
  var SELECTOR_DATA_TOGGLE = (cov_f03z6lr7t().s[20]++, '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]');
  var SELECTOR_DROPDOWN_TOGGLE = (cov_f03z6lr7t().s[21]++, '.dropdown-toggle');
  var SELECTOR_DROPDOWN_ACTIVE_CHILD = (cov_f03z6lr7t().s[22]++, '> .dropdown-menu .active');
  /**
   * Class definition
   */

  var Tab = /*#__PURE__*/function () {
    function Tab(element) {
      cov_f03z6lr7t().f[0]++;
      cov_f03z6lr7t().s[23]++;
      this._element = element;
    } // Getters


    var _proto = Tab.prototype;

    // Public
    _proto.show = function show() {
      var _this = this;

      cov_f03z6lr7t().f[2]++;
      cov_f03z6lr7t().s[25]++;

      if ((cov_f03z6lr7t().b[1][0]++, this._element.parentNode) && (cov_f03z6lr7t().b[1][1]++, this._element.parentNode.nodeType === Node.ELEMENT_NODE) && (cov_f03z6lr7t().b[1][2]++, $__default["default"](this._element).hasClass(CLASS_NAME_ACTIVE)) || (cov_f03z6lr7t().b[1][3]++, $__default["default"](this._element).hasClass(CLASS_NAME_DISABLED))) {
        cov_f03z6lr7t().b[0][0]++;
        cov_f03z6lr7t().s[26]++;
        return;
      } else {
        cov_f03z6lr7t().b[0][1]++;
      }

      var target;
      var previous;
      var listElement = (cov_f03z6lr7t().s[27]++, $__default["default"](this._element).closest(SELECTOR_NAV_LIST_GROUP)[0]);
      var selector = (cov_f03z6lr7t().s[28]++, Util__default["default"].getSelectorFromElement(this._element));
      cov_f03z6lr7t().s[29]++;

      if (listElement) {
        cov_f03z6lr7t().b[2][0]++;
        var itemSelector = (cov_f03z6lr7t().s[30]++, (cov_f03z6lr7t().b[4][0]++, listElement.nodeName === 'UL') || (cov_f03z6lr7t().b[4][1]++, listElement.nodeName === 'OL') ? (cov_f03z6lr7t().b[3][0]++, SELECTOR_ACTIVE_UL) : (cov_f03z6lr7t().b[3][1]++, SELECTOR_ACTIVE));
        cov_f03z6lr7t().s[31]++;
        previous = $__default["default"].makeArray($__default["default"](listElement).find(itemSelector));
        cov_f03z6lr7t().s[32]++;
        previous = previous[previous.length - 1];
      } else {
        cov_f03z6lr7t().b[2][1]++;
      }

      var hideEvent = (cov_f03z6lr7t().s[33]++, $__default["default"].Event(EVENT_HIDE, {
        relatedTarget: this._element
      }));
      var showEvent = (cov_f03z6lr7t().s[34]++, $__default["default"].Event(EVENT_SHOW, {
        relatedTarget: previous
      }));
      cov_f03z6lr7t().s[35]++;

      if (previous) {
        cov_f03z6lr7t().b[5][0]++;
        cov_f03z6lr7t().s[36]++;
        $__default["default"](previous).trigger(hideEvent);
      } else {
        cov_f03z6lr7t().b[5][1]++;
      }

      cov_f03z6lr7t().s[37]++;
      $__default["default"](this._element).trigger(showEvent);
      cov_f03z6lr7t().s[38]++;

      if ((cov_f03z6lr7t().b[7][0]++, showEvent.isDefaultPrevented()) || (cov_f03z6lr7t().b[7][1]++, hideEvent.isDefaultPrevented())) {
        cov_f03z6lr7t().b[6][0]++;
        cov_f03z6lr7t().s[39]++;
        return;
      } else {
        cov_f03z6lr7t().b[6][1]++;
      }

      cov_f03z6lr7t().s[40]++;

      if (selector) {
        cov_f03z6lr7t().b[8][0]++;
        cov_f03z6lr7t().s[41]++;
        target = document.querySelector(selector);
      } else {
        cov_f03z6lr7t().b[8][1]++;
      }

      cov_f03z6lr7t().s[42]++;

      this._activate(this._element, listElement);

      cov_f03z6lr7t().s[43]++;

      var complete = function complete() {
        cov_f03z6lr7t().f[3]++;
        var hiddenEvent = (cov_f03z6lr7t().s[44]++, $__default["default"].Event(EVENT_HIDDEN, {
          relatedTarget: _this._element
        }));
        var shownEvent = (cov_f03z6lr7t().s[45]++, $__default["default"].Event(EVENT_SHOWN, {
          relatedTarget: previous
        }));
        cov_f03z6lr7t().s[46]++;
        $__default["default"](previous).trigger(hiddenEvent);
        cov_f03z6lr7t().s[47]++;
        $__default["default"](_this._element).trigger(shownEvent);
      };

      cov_f03z6lr7t().s[48]++;

      if (target) {
        cov_f03z6lr7t().b[9][0]++;
        cov_f03z6lr7t().s[49]++;

        this._activate(target, target.parentNode, complete);
      } else {
        cov_f03z6lr7t().b[9][1]++;
        cov_f03z6lr7t().s[50]++;
        complete();
      }
    };

    _proto.dispose = function dispose() {
      cov_f03z6lr7t().f[4]++;
      cov_f03z6lr7t().s[51]++;
      $__default["default"].removeData(this._element, DATA_KEY);
      cov_f03z6lr7t().s[52]++;
      this._element = null;
    } // Private
    ;

    _proto._activate = function _activate(element, container, callback) {
      var _this2 = this;

      cov_f03z6lr7t().f[5]++;
      var activeElements = (cov_f03z6lr7t().s[53]++, (cov_f03z6lr7t().b[11][0]++, container) && ((cov_f03z6lr7t().b[11][1]++, container.nodeName === 'UL') || (cov_f03z6lr7t().b[11][2]++, container.nodeName === 'OL')) ? (cov_f03z6lr7t().b[10][0]++, $__default["default"](container).find(SELECTOR_ACTIVE_UL)) : (cov_f03z6lr7t().b[10][1]++, $__default["default"](container).children(SELECTOR_ACTIVE)));
      var active = (cov_f03z6lr7t().s[54]++, activeElements[0]);
      var isTransitioning = (cov_f03z6lr7t().s[55]++, (cov_f03z6lr7t().b[12][0]++, callback) && (cov_f03z6lr7t().b[12][1]++, active) && (cov_f03z6lr7t().b[12][2]++, $__default["default"](active).hasClass(CLASS_NAME_FADE)));
      cov_f03z6lr7t().s[56]++;

      var complete = function complete() {
        cov_f03z6lr7t().f[6]++;
        cov_f03z6lr7t().s[57]++;
        return _this2._transitionComplete(element, active, callback);
      };

      cov_f03z6lr7t().s[58]++;

      if ((cov_f03z6lr7t().b[14][0]++, active) && (cov_f03z6lr7t().b[14][1]++, isTransitioning)) {
        cov_f03z6lr7t().b[13][0]++;
        var transitionDuration = (cov_f03z6lr7t().s[59]++, Util__default["default"].getTransitionDurationFromElement(active));
        cov_f03z6lr7t().s[60]++;
        $__default["default"](active).removeClass(CLASS_NAME_SHOW).one(Util__default["default"].TRANSITION_END, complete).emulateTransitionEnd(transitionDuration);
      } else {
        cov_f03z6lr7t().b[13][1]++;
        cov_f03z6lr7t().s[61]++;
        complete();
      }
    };

    _proto._transitionComplete = function _transitionComplete(element, active, callback) {
      cov_f03z6lr7t().f[7]++;
      cov_f03z6lr7t().s[62]++;

      if (active) {
        cov_f03z6lr7t().b[15][0]++;
        cov_f03z6lr7t().s[63]++;
        $__default["default"](active).removeClass(CLASS_NAME_ACTIVE);
        var dropdownChild = (cov_f03z6lr7t().s[64]++, $__default["default"](active.parentNode).find(SELECTOR_DROPDOWN_ACTIVE_CHILD)[0]);
        cov_f03z6lr7t().s[65]++;

        if (dropdownChild) {
          cov_f03z6lr7t().b[16][0]++;
          cov_f03z6lr7t().s[66]++;
          $__default["default"](dropdownChild).removeClass(CLASS_NAME_ACTIVE);
        } else {
          cov_f03z6lr7t().b[16][1]++;
        }

        cov_f03z6lr7t().s[67]++;

        if (active.getAttribute('role') === 'tab') {
          cov_f03z6lr7t().b[17][0]++;
          cov_f03z6lr7t().s[68]++;
          active.setAttribute('aria-selected', false);
        } else {
          cov_f03z6lr7t().b[17][1]++;
        }
      } else {
        cov_f03z6lr7t().b[15][1]++;
      }

      cov_f03z6lr7t().s[69]++;
      $__default["default"](element).addClass(CLASS_NAME_ACTIVE);
      cov_f03z6lr7t().s[70]++;

      if (element.getAttribute('role') === 'tab') {
        cov_f03z6lr7t().b[18][0]++;
        cov_f03z6lr7t().s[71]++;
        element.setAttribute('aria-selected', true);
      } else {
        cov_f03z6lr7t().b[18][1]++;
      }

      cov_f03z6lr7t().s[72]++;
      Util__default["default"].reflow(element);
      cov_f03z6lr7t().s[73]++;

      if (element.classList.contains(CLASS_NAME_FADE)) {
        cov_f03z6lr7t().b[19][0]++;
        cov_f03z6lr7t().s[74]++;
        element.classList.add(CLASS_NAME_SHOW);
      } else {
        cov_f03z6lr7t().b[19][1]++;
      }

      var parent = (cov_f03z6lr7t().s[75]++, element.parentNode);
      cov_f03z6lr7t().s[76]++;

      if ((cov_f03z6lr7t().b[21][0]++, parent) && (cov_f03z6lr7t().b[21][1]++, parent.nodeName === 'LI')) {
        cov_f03z6lr7t().b[20][0]++;
        cov_f03z6lr7t().s[77]++;
        parent = parent.parentNode;
      } else {
        cov_f03z6lr7t().b[20][1]++;
      }

      cov_f03z6lr7t().s[78]++;

      if ((cov_f03z6lr7t().b[23][0]++, parent) && (cov_f03z6lr7t().b[23][1]++, $__default["default"](parent).hasClass(CLASS_NAME_DROPDOWN_MENU))) {
        cov_f03z6lr7t().b[22][0]++;
        var dropdownElement = (cov_f03z6lr7t().s[79]++, $__default["default"](element).closest(SELECTOR_DROPDOWN)[0]);
        cov_f03z6lr7t().s[80]++;

        if (dropdownElement) {
          cov_f03z6lr7t().b[24][0]++;
          var dropdownToggleList = (cov_f03z6lr7t().s[81]++, [].slice.call(dropdownElement.querySelectorAll(SELECTOR_DROPDOWN_TOGGLE)));
          cov_f03z6lr7t().s[82]++;
          $__default["default"](dropdownToggleList).addClass(CLASS_NAME_ACTIVE);
        } else {
          cov_f03z6lr7t().b[24][1]++;
        }

        cov_f03z6lr7t().s[83]++;
        element.setAttribute('aria-expanded', true);
      } else {
        cov_f03z6lr7t().b[22][1]++;
      }

      cov_f03z6lr7t().s[84]++;

      if (callback) {
        cov_f03z6lr7t().b[25][0]++;
        cov_f03z6lr7t().s[85]++;
        callback();
      } else {
        cov_f03z6lr7t().b[25][1]++;
      }
    } // Static
    ;

    Tab._jQueryInterface = function _jQueryInterface(config) {
      cov_f03z6lr7t().f[8]++;
      cov_f03z6lr7t().s[86]++;
      return this.each(function () {
        cov_f03z6lr7t().f[9]++;
        var $this = (cov_f03z6lr7t().s[87]++, $__default["default"](this));
        var data = (cov_f03z6lr7t().s[88]++, $this.data(DATA_KEY));
        cov_f03z6lr7t().s[89]++;

        if (!data) {
          cov_f03z6lr7t().b[26][0]++;
          cov_f03z6lr7t().s[90]++;
          data = new Tab(this);
          cov_f03z6lr7t().s[91]++;
          $this.data(DATA_KEY, data);
        } else {
          cov_f03z6lr7t().b[26][1]++;
        }

        cov_f03z6lr7t().s[92]++;

        if (typeof config === 'string') {
          cov_f03z6lr7t().b[27][0]++;
          cov_f03z6lr7t().s[93]++;

          if (typeof data[config] === 'undefined') {
            cov_f03z6lr7t().b[28][0]++;
            cov_f03z6lr7t().s[94]++;
            throw new TypeError("No method named \"" + config + "\"");
          } else {
            cov_f03z6lr7t().b[28][1]++;
          }

          cov_f03z6lr7t().s[95]++;
          data[config]();
        } else {
          cov_f03z6lr7t().b[27][1]++;
        }
      });
    };

    _createClass(Tab, null, [{
      key: "VERSION",
      get: function get() {
        cov_f03z6lr7t().f[1]++;
        cov_f03z6lr7t().s[24]++;
        return VERSION;
      }
    }]);

    return Tab;
  }();
  /**
   * Data API implementation
   */


  cov_f03z6lr7t().s[96]++;
  $__default["default"](document).on(EVENT_CLICK_DATA_API, SELECTOR_DATA_TOGGLE, function (event) {
    cov_f03z6lr7t().f[10]++;
    cov_f03z6lr7t().s[97]++;
    event.preventDefault();
    cov_f03z6lr7t().s[98]++;

    Tab._jQueryInterface.call($__default["default"](this), 'show');
  });
  /**
   * jQuery
   */

  cov_f03z6lr7t().s[99]++;
  $__default["default"].fn[NAME] = Tab._jQueryInterface;
  cov_f03z6lr7t().s[100]++;
  $__default["default"].fn[NAME].Constructor = Tab;
  cov_f03z6lr7t().s[101]++;

  $__default["default"].fn[NAME].noConflict = function () {
    cov_f03z6lr7t().f[11]++;
    cov_f03z6lr7t().s[102]++;
    $__default["default"].fn[NAME] = JQUERY_NO_CONFLICT;
    cov_f03z6lr7t().s[103]++;
    return Tab._jQueryInterface;
  };

  return Tab;

}));
//# sourceMappingURL=tab.js.map
