// (function ( $ ) {
//     var OPTIONS = {};
//     $.fn.extend( {
//         setTime: function ( params ) {
//
//             var defaults = {
//                 date       : '#buy_time',
//                 date_hidden: '#buy_time_hidden',
//                 start_date : '#start_date',
//                 end_date   : '#end_date',
//                 range      : false,
//                 onSelect   : {}
//             };
//
//             // 合并参数，放入全集变量
//             OPTIONS = $.extend( defaults, params );
//
//
//             laydate.render( {
//                 elem    : OPTIONS.date, //指定元素
//                 lang    : 'cn',
//                 range   : OPTIONS.range,
//                 calendar: true,
//                 type    : 'date',
//                 format  : 'yyyy-MM-dd',
//                 trigger : 'click',
//                 zIndex  : 99999999,
//                 done    : function ( value, date, endDate ) {
//                     if ( OPTIONS.range ) {
//                         $( OPTIONS.start_date ).val( dateSplice( date ) );
//                         $( OPTIONS.end_date ).val( dateSplice( endDate ) );
//                     } else {
//                         $( OPTIONS.date_hidden ).val( value );
//                     }
//                     if ( OPTIONS.onSelect != "{}") {
//                         OPTIONS.onSelect();
//                     }
//                 }
//             } );
//
//
//         }
//     } )
// })( jQuery );

/**
 *判断参数是否为空、0、undefined
 * @author knight
 */
function isNull( data ) {
    return (data == "" || data == undefined || data == null || data == 0 || data == {}) ? true : false;
}

/**
 * 时间处理
 * @param obj
 * @returns {string}
 */
function dateSplice( obj ) {
    return (obj.year + '-' + obj.month + '-' + obj.date);
}

//本周第一天
function showWeekFirstDay() {
    var Nowdate      = new Date();
    var WeekFirstDay = new Date( Nowdate - (Nowdate.getDay() - 1) * 86400000 );
    M                = Number( WeekFirstDay.getMonth() ) + 1;
    var nowYear      = WeekFirstDay.getYear();
    nowYear += ( nowYear < 2000) ? 1900 : 0;
    return nowYear + "-" + M + "-" + WeekFirstDay.getDate();
}

//本周最后天
function showWeekLastDay() {
    var Nowdate      = new Date();
    var WeekFirstDay = new Date( Nowdate - (Nowdate.getDay() - 1) * 86400000 );
    var WeekLastDay  = new Date( (WeekFirstDay / 1000 + 6 * 86400) * 1000 );
    M                = Number( WeekLastDay.getMonth() ) + 1;
    var nowYear      = WeekFirstDay.getYear();
    nowYear += ( nowYear < 2000) ? 1900 : 0;
    return nowYear + "-" + M + "-" + WeekLastDay.getDate();
}

//本月第一天
function showMonthFirstDay() {
    var Nowdate       = new Date();
    var MonthFirstDay = new Date( Nowdate.getYear(), Nowdate.getMonth(), 1 );
    M                 = Number( MonthFirstDay.getMonth() ) + 1;
    var nowYear       = Nowdate.getYear();
    nowYear += ( nowYear < 2000) ? 1900 : 0;
    return nowYear + "-" + M + "-" + MonthFirstDay.getDate();
}

//本月最后一天
function showMonthLastDay() {
    var Nowdate           = new Date();
    var MonthNextFirstDay = new Date( Nowdate.getYear(), Nowdate.getMonth() + 1, 1 );
    var MonthLastDay      = new Date( MonthNextFirstDay - 86400000 );
    M                     = Number( MonthLastDay.getMonth() ) + 1;
    var nowYear           = Nowdate.getYear();
    nowYear += ( nowYear < 2000) ? 1900 : 0;
    return nowYear + "-" + M + "-" + MonthLastDay.getDate();
}