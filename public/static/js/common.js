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
 * 时间处理
 * @param obj
 * @returns {string}
 */
function dateSplice( obj ) {
    return (obj.year + '-' + obj.month + '-' + obj.date);
}