/**
 * Created by wangtj.
 * version 1.0
 */
(function ($) {
    if (!$) {
        throw new Error('you should use jQuery first');
    }
    if (!Array.prototype.indexOf) {
        Array.prototype.indexOf = function (e) {
            for (var i = 0; i < this.length; i++) {
                if (this[i] == e) {
                    return i;
                }
            }
            return -1;
        }
    }

    function FlexDate(option) {
        var _option = {
            e: '',
            type: 'second',
            value: '',//初始值
            format: 'yyyy-MM-dd HH:mm:ss',
            clearBtn: true,
            todayBtn: true,
            confirmBtn: true,
            min:'',//最小值
            max:'',//最大值
            zIndex:999,//层级
            bindClick:true,//是否绑定文本框点击事件
            confirm: function (value) {
            }
        };
        var con;
        this.option = $.extend(_option, {skin: FlexDate.skin}, option);
        this.option.types=['year', 'month', 'date', 'hour', 'minute', 'second'];
        this.option.today = util.getToday(this.option.format);
        this.option.dtf=true;
        if(this.option.value instanceof Date){
            this.option.value=util.getToday(this.option.format,this.option.value);
        }else if(!this.option.value){
            this.option.value = this.option.today;
            this.option.dtf=false;
        }
        
        con = createFlexDate(this.option);
        this.page=con.children('.flexDate_left');
        event.bindEvent.call(this,this.option, this.page);
    }
    function handleMinMax(format,value){
        if(value instanceof Date){
            return util.getToday(format,value);
        }else{
            return value;
        }
    }
    //实例方法
    FlexDate.prototype.setMin=function(min){
        this.option.min=handleMinMax(this.option.format,min);
        if(!util.compare(this.option.value,this.option.min,this.option.max)){
            $(this.option.e).val('');
        }
        redraw(this);
    };
    FlexDate.prototype.setMax=function(max){
        this.option.max=handleMinMax(this.option.format,max);
        if(!util.compare(this.option.value,this.option.min,this.option.max)){
            $(this.option.e).val('');
        }
        redraw(this);
    };
    FlexDate.prototype.show=function () {
        var option=this.option,page=this.page,con=page.parent();
        var obj=$(option.e)[0];
        var scrollTop=$(window).scrollTop();
        var winHeight=$(window).height();
        var offsetTop=util.offsetTop(obj);
        var offsetLeft=util.offsetLeft(obj);
        var conHeight=con.outerHeight();
        if (scrollTop+winHeight-offsetTop-$(option.e).outerHeight()<conHeight) {
            con.css({
                left: offsetLeft,
                top: offsetTop-conHeight
            })
        } else {
            con.css({
                left: offsetLeft,
                top: offsetTop + $(option.e).outerHeight()
            })
        }
        page.find('.flexDate_body>div:last-child').show().siblings().hide();
        page.parent().show().children('.flexDate_left');
    };
    FlexDate.prototype.hide=function () {
        this.page.parent().hide();
    };
    FlexDate.prototype.reset=function (format) {
        var con;
        this.page.parent().remove();
        this.option.value=util.resetTime(this.option.value,this.option.format,format);
        this.option.format=format;
        this.option.dtf=Boolean($(this.option.e).val());
        con = createFlexDate(this.option);
        this.page=con.children('.flexDate_left');
        event.bindEvent.call(this,this.option, this.page);
    };
    //重置头部,重绘3张卡片和时间
    function redraw(me){
        var option=me.option,page=me.page;
        var yearStr = util.getSelectedYear(option.value, option.format),
            monthStr = util.getSelectedMonthStr(option.value, option.format);
        page.find('.flexDate_year>b').text(yearStr);
        page.find('.flexDate_month>b').text(monthStr);

        page.find('.flexDate_yearWrapper').html(html.yearCard(option));
        page.find('.flexDate_monthWrapper').html(html.monthCard(option));
        page.find('.flexDate_dateWrapper').html(html.dateCard(option));
        if (option.types.indexOf(option.type) > 2) {
            page.find('.flexDate_time').replaceWith(html.time(option));
        }
    }
    FlexDate.setSkin = function (skin) {
        var style = '<style>.flexDate_header,' +
            'li.flexDate_selecting,' +
            '.flexDate_yearCard > li:hover,' +
            '.flexDate_monthCard > li:hover,' +
            '.flexDate_pro,' +
            '.flexDate_ball > em,' +
            '.flexDate_ball > i,' +
            '.flexDate_oper > a {background-color: {};}' +
            'li.flexDate_cur {color: {};}' +
            'li.flexDate_selected {background-color: {};color: white;}' +
            '.flexDate_dateCard > ul > li:hover {border-color: {};}' +
            '.flexDate_slide {border-bottom: 2px solid {};}' +
            '.flexDate_yearCard>li:hover,.flexDate_monthCard>li:hover{border-color:{};background-color: #ffffff;color:#666666;' + '}' +
            '.flexDate_tip>.flexDate_tipBg{background-color: {};}</style>';
        style = style.replace(/\{\}/g, skin);
        $('head').append(style);

    };
    function createFlexDate(option) {
        var tag,con;
        option.dtf&&$(option.e).val(option.value);
        if (option.format.indexOf('s') != -1) {
            option.type = 'second';
        } else if (option.format.indexOf('m') != -1) {
            option.type = 'minute';
        } else if (option.format.indexOf('H') != -1) {
            option.type = 'hour';
        } else if (option.format.indexOf('d') != -1) {
            option.type = 'date';
        } else if (option.format.indexOf('M') != -1) {
            option.type = 'month';
        } else if (option.format.indexOf('y') != -1) {
            option.type = 'year';
        } else {
            throw Error('format is wrong');
        }
        option.min=handleMinMax(option.format,option.min);
        option.max=handleMinMax(option.format,option.max);
        
         tag = html.containerL(option) +
            html.leftBorder +
            html.leftL +
            html.header(option) +
            html.bodyL +
            html.yearWrapperL +
            html.yearCard(option) +
            html.yearWrapperR +
            (option.types.indexOf(option.type) < 1 ? '' : html.monthWrapperL + html.monthCard(option) + html.monthWrapperR) +
            (option.types.indexOf(option.type) < 2 ? '' : html.dateWrapperL + html.dateCard(option) + html.dateWrapperR) +
            html.bodyR +
            (option.types.indexOf(option.type) < 3 ? '' : html.time(option)) +
            html.oper(option) +
            html.tip +
            html.leftR +
            html.containerR;
         con = $('body').append(tag).children('.flexDate_container:last-child').addClass('flexDate_fadeInUp');


        if ('year' == option.type) {
            con.find(".flexDate_yearWrapper").show();
        } else if ('month' == option.type) {
            con.find(".flexDate_monthWrapper").show();
        } else {
            con.find(".flexDate_dateWrapper").show();
        }
        return con;
    }

    var util = {
        date: new Date(),
        img: new Image(),
        YEAR: 'y',
        MONTH: 'M',
        DATE: 'd',
        HOUR: 'H',
        MINUTE: 'm',
        SECOND: 's',
        current: function () {
            return this.getCurYear() + '-' + this.getCurMonthStr() + '-' + this.getCurDateStr() + ' ' + this.getCurHourStr() + ':' + this.getCurMinuteStr() + ':' + this.getCurSecondStr();
        },
        getToday: function (format, dateObj) {
            return format.replace(/y+/, this.getCurYear(dateObj)).replace(/M+/, this.getCurMonthStr(dateObj)).replace(/d+/, this.getCurDateStr(dateObj))
                .replace(/H+/, this.getCurHourStr(dateObj)).replace(/m+/, this.getCurMinuteStr(dateObj)).replace(/s+/, this.getCurSecondStr(dateObj));
        },
        resetTime:function (time,oldFormat, format) {
            var monthStr=this.getSelectedMonthStr(time,oldFormat);monthStr=monthStr=='00'?'01':monthStr;
            var dayStr=this.getSelectedDateStr(time,oldFormat);dayStr=dayStr=='00'?'01':dayStr;
            return format.replace(/y+/, this.getSelectedYear(time,oldFormat)).replace(/M+/, monthStr)
                .replace(/d+/, dayStr).replace(/H+/, this.getSelectedHourStr(time,oldFormat))
                .replace(/m+/, this.getSelectedMinuteStr(time,oldFormat)).replace(/s+/, this.getSelectedSecondStr(time,oldFormat));
        },
        getCurYear: function (dateObj) {
            return dateObj ? dateObj.getFullYear() : this.date.getFullYear();
        },
        getCurMonth: function (dateObj) {
            return dateObj ? dateObj.getMonth() + 1 : this.date.getMonth() + 1;
        },
        getCurMonthStr: function (dateObj) {
            var month = dateObj ? dateObj.getMonth() + 1 : this.date.getMonth() + 1;
            return month > 9 ? month : '0' + month;
        },
        getCurDate: function (dateObj) {
            return dateObj ? dateObj.getDate() : this.date.getDate();
        },
        getCurDateStr: function (dateObj) {
            var date = dateObj ? dateObj.getDate() : this.date.getDate();
            return date > 9 ? date : '0' + date;
        },
        getCurHour: function (dateObj) {
            return dateObj ? dateObj.getHours() : this.date.getHours();
        },
        getCurHourStr: function (dateObj) {
            var hour = dateObj ? dateObj.getHours() : this.date.getHours();
            return hour > 9 ? hour : '0' + hour;
        },
        getCurMinute: function (dateObj) {
            return dateObj ? dateObj.getMinutes() : this.date.getMinutes();
        },
        getCurMinuteStr: function (dateObj) {
            var minute = dateObj ? dateObj.getMinutes() : this.date.getMinutes();
            return minute > 9 ? minute : '0' + minute;
        },
        getCurSecond: function (dateObj) {
            return dateObj ? dateObj.getSeconds() : this.date.getSeconds();
        },
        getCurSecondStr: function (dateObj) {
            var second = dateObj ? dateObj.getSeconds() : this.date.getSeconds();
            return second > 9 ? second : '0' + second;
        },
        getSelectedYear: function (value, format) {
            var begin = format.indexOf('y');
            var end = format.lastIndexOf('y');
            return Number(value.substring(begin, end + 1));
        },
        getSelectedMonth: function (value, format) {
            var begin = format.indexOf('M');
            var end = format.lastIndexOf('M');
            return Number(value.substring(begin, end + 1));
        },
        getSelectedMonthStr: function (value, format) {
            var month = this.getSelectedMonth(value, format);
            return month > 9 ? month : '0' + month;
        },
        getSelectedDate: function (value, format) {
            var begin = format.indexOf('d');
            var end = format.lastIndexOf('d');
            return Number(value.substring(begin, end + 1));
        },
        getSelectedDateStr: function (value, format) {
            var date = this.getSelectedDate(value, format);
            return date > 9 ? date : '0' + date;
        },
        getSelectedHour: function (value, format) {
            var begin = format.indexOf('H');
            var end = format.lastIndexOf('H');
            return Number(value.substring(begin, end + 1));
        },
        getSelectedHourStr: function (value, format) {
            var hour = this.getSelectedHour(value, format);
            return hour > 9 ? hour : '0' + hour;
        },
        getSelectedMinute: function (value, format) {
            var begin = format.indexOf('m');
            var end = format.lastIndexOf('m');
            return Number(value.substring(begin, end + 1));
        },
        getSelectedMinuteStr: function (value, format) {
            var minute = this.getSelectedMinute(value, format);
            return minute > 9 ? minute : '0' + minute;
        },
        getSelectedSecond: function (value, format) {
            var begin = format.indexOf('s');
            var end = format.lastIndexOf('s');
            return Number(value.substring(begin, end + 1));
        },
        getSelectedSecondStr: function (value, format) {
            var second = this.getSelectedSecond(value, format);
            return second > 9 ? second : '0' + second;
        },
        setSelectedValue: function (value, time, type, format) {
            var begin = format.indexOf(type);
            var end = format.lastIndexOf(type);
            var front = value.substring(0, begin), endBack = value.substring(end + 1);
            return front + time + endBack;
        },
        getMonthLength: function (year, month) {//获取某个月的天数,2017 1,number
            if (4 == month || 6 == month || 9 == month || 11 == month) {
                return 30;
            } else {
                if (2 == month) {
                    return year % 4 == 0 ? 29 : 28;
                } else {
                    return 31;
                }
            }

        },
        gt: function (time1, time2) {
            return time1.replace(/\D/g, '') > time2.replace(/\D/g, '');
        },
        gte: function (time1, time2) {
            return time1.replace(/\D/g, '') >= time2.replace(/\D/g, '');
        },
        lt: function (time1, time2) {
            return time1.replace(/\D/g, '') < time2.replace(/\D/g, '');
        },
        lte: function (time1, time2) {
            return time1.replace(/\D/g, '') <= time2.replace(/\D/g, '');
        },
        supportAnim: function () {
            return this.img.style.animation == '' || this.img.style.webkitAnimation == '';
        },
        setDelay: function (func, time) {
            if (this.supportAnim()) {
                setTimeout(function () {
                    func();
                }, time);
            } else {
                func();
            }
        },
        compare:function(cur,min,max){
            var strCur=(cur+'').replace(/\D/g,'');
            var curLen=strCur.length;
            var minFlag=true;
            var maxFlag=true;
            if(min){
                var strMin=(min+'').replace(/\D/g,'');
                var minLen=strMin.length;
                if(curLen>minLen){
                    minFlag=strCur.substring(0,minLen)>=strMin;
                }else{
                    minFlag=strCur>=strMin.substring(0,curLen);
                }
            }
            if(max){
                var strMax=(max+'').replace(/\D/g,'');
                var maxLen=strMax.length;
                if(curLen>maxLen){
                    maxFlag=strCur.substring(0,maxLen)<=strMax;
                }else{
                    maxFlag=strCur<=strMax.substring(0,curLen);
                }
            }
            return minFlag&&maxFlag;

        },
        toInt:function(str){
            return parseInt(str,10);
        },
        monthSub:function(month,int){
            var t=this.toInt(month)+int;
            if(t<1){
                return '12';
            }else if(t>12){
                return '01';
            }
        },
        offsetTop:function (e) {
            var top = e.offsetTop;
            var parent = e.offsetParent;
            while(parent){
                top += parent.offsetTop;
                parent = parent.offsetParent;
            }
            return top;
        },
        offsetLeft:function (e) {
            var left = e.offsetLeft;
            var parent = e.offsetParent;
            while(parent){
                left += parent.offsetLeft;
                parent = parent.offsetParent;
            }
            return left;
        }
    };
    var html = {
        containerL: function (option) {
            return '<div class="flexDate_container " style="z-index:'+option.zIndex+'">';
        },
        containerR: '</div>',
        divR: '</div>',
        leftBorder: '<div class="flexDate_leftBorder"></div>',
        rightBorder: '<div class="flexDate_rightBorder"></div>',
        leftL: '<div class="flexDate_left">',
        leftR: '</div>',
        rightL: '<div class="flexDate_right">',
        rightR: '</div>',
        header: function (option) {
            var tag = '<div class="flexDate_header">' +
                '<span class="flexDate_year">' +
                '<b >' + util.getSelectedYear(option.value, option.format) + '</b>年' +
                '</span>';
            if (option.types.indexOf(option.type) > 0) {
                tag += '<span class="flexDate_month">' +
                    '<b >' + util.getSelectedMonthStr(option.value, option.format) + '</b>月' +
                    '</span>';
            }
            tag += '<i class="flexDate_lArrow"></i>' +
                '<i class="flexDate_rArrow"></i>' +
                '</div>';
            return tag;
        },
        bodyL: '<div class="flexDate_body">',
        bodyR: '</div>',
        yearWrapperL: '<div class="flexDate_yearWrapper flexDate_vanishIn">',
        yearWrapperR: '</div>',
        yearCard: function (option) {
            var tag = '<ul class="flexDate_yearCard">',
                thisYear = util.getCurYear(),
                selectedYear = util.getSelectedYear(option.value, option.format),
                i = selectedYear - 5,
                len = i + 15;
            for (i; i <= len; i++) {
                tag += '<li class="' + (selectedYear == i ? 'flexDate_selected ' : ' ') + (thisYear == i ? 'flexDate_cur ' : '') +(util.compare(i,option.min,option.max)?'':'flexDate_disabled')+ '"  >' + i + '</li>';
            }
            tag += '</ul>';
            return tag;

        },
        monthWrapperL: '<div class="flexDate_monthWrapper flexDate_rotateIn" >',
        monthWrapperR: '</div>',
        monthCard: function (option) {
            var tag = '<ul class="flexDate_monthCard">',
                thisYear = util.getCurYear(),
                selectedYear = util.getSelectedYear(option.value, option.format),
                thisMonth = util.getCurMonth(),
                selectedMonth = util.getSelectedMonth(option.value, option.format);
            for (var i = 1; i <= 12; i++) {
                tag += '<li class="' + (selectedMonth == i ? 'flexDate_selected ' : ' ') + ((!selectedYear || thisYear == selectedYear) && thisMonth == i ? 'flexDate_cur ' : '') +(util.compare(selectedYear+(i < 10 ? '0' + i : i),option.min,option.max)?'':'flexDate_disabled')+ '"><span>' + (i < 10 ? '0' + i : i) + '</span>月</li>';
            }
            tag += '</ul>';
            return tag;
        },
        dateWrapperL: '<div class="flexDate_dateWrapper flexDate_zoomIn">',
        dateWrapperR: '</div>',
        dateCard: function (option) {
            var year = util.getSelectedYear(option.value, option.format),
                month = util.getSelectedMonth(option.value, option.format),
                thisLen = util.getMonthLength(year, month),
                preLen = util.getMonthLength(month > 1 ? year : year - 1, month != 1 ? month - 1 : 12),
                dayOfWeek = new Date(year + '/' + month + '/01').getDay(),
                preSul = dayOfWeek == 0 ? 7 : dayOfWeek,
                sufSul = 42 - thisLen - preSul;
            var selectedDate = util.getSelectedDate(option.value, option.format),
                thisDate = util.getCurDate(),
                isCurMonth = year == util.getCurYear() && month == util.getCurMonth(),
                isPrevMonth = (month > 1 ? year : year - 1) == util.getCurYear() && (month > 1 ? month - 1 : 12) == util.getCurMonth(),
                isNextMonth = (month > 1 ? year : year + 1) == util.getCurYear() && (month > 1 ? month + 1 : 12) == util.getCurMonth(),
                i;
            var tag = '<div  class="flexDate_dateCard">' +
                '<ul>' +
                '<li>日</li>' +
                '<li>一</li>' +
                '<li>二</li>' +
                '<li>三</li>' +
                '<li>四</li>' +
                '<li>五</li>' +
                '<li>六</li>' +
                '</ul>' +
                '<ul>';
            var prevYearMonth=month > 1 ? year+''+(month-1<10?'0'+(month-1):month-1) : year - 1+''+12;
            var nextYearMonth=month != 12 ? year+''+(month+1<10?'0'+(month+1):month+1) : year + 1+'01';
            for (i = preLen - preSul + 1; i <= preLen; i++) {
                tag += '<li class="flexDate_others ' + (isPrevMonth && thisDate == i ? 'flexDate_cur ' : '') +(util.compare(prevYearMonth+(i < 10 ? '0' + i : i),option.min,option.max)?'':'flexDate_disabled')+ '">' + i + '</li>';
            }
            for (i = 1; i <= thisLen; i++) {
                tag += '<li class="' + (selectedDate == i ? 'flexDate_selected ' : '') + (isCurMonth && thisDate == i ? 'flexDate_cur ' : '') +(util.compare(year+''+(month<10?'0'+month:month)+(i < 10 ? '0' + i : i),option.min,option.max)?'':'flexDate_disabled')+ '">' + i + '</li>';
            }
            for (i = 1; i <= sufSul; i++) {
                tag += '<li class="flexDate_others ' + (isNextMonth && thisDate == i ? 'flexDate_cur ' : '') +(util.compare(nextYearMonth+(i < 10 ? '0' + i : i),option.min,option.max)?'':'flexDate_disabled')+ '">' + i + '</li>';
            }
            tag += '</ul></div>';
            return tag;

        },
        time: function (option) {
            var hour = util.getSelectedHourStr(option.value, option.format),
                minute = option.types.indexOf(option.type) > 3 ? util.getSelectedMinuteStr(option.value, option.format) : '--',
                second = option.types.indexOf(option.type) > 4 ? util.getSelectedSecondStr(option.value, option.format) : '--',
                pro;
            if ('hour' == option.type) {
                pro = Number(hour) / 23 * event.barLen;
            } else if ('minute' == option.type) {
                pro = Number(minute) / 59 * event.barLen;
            } else {
                pro = Number(second) / 59 * event.barLen;
            }
            return '<div class="flexDate_time">' +
                '<div class="flexDate_timeShow">' +
                '<span class="flexDate_h ' + ('hour' == option.type ? 'flexDate_slide' : '') + '">' + hour + '</span>' +
                '：' +
                '<span class="flexDate_m ' + ('minute' == option.type ? 'flexDate_slide' : '') + '">' + minute + '</span>' +
                '：' +
                '<span class="flexDate_s ' + ('second' == option.type ? 'flexDate_slide' : '') + '">' + second + '</span>' +
                '</div>' +
                '<div class="flexDate_timePicker">' +
                '<i class="flexDate_bar">' +
                '<div class="flexDate_pro" style="width:' + pro + 'px;"></div>' +
                '<b class="flexDate_ball" style="left:' + pro + 'px">' +
                '<em ></em>' +
                '<i ></i>' +
                '</b>' +
                '</i>' +
                '</div>' +
                '</div>';
        },
        oper: function (option) {
            if(!option.clearBtn&&!option.todayBtn&&!option.confirmBtn)return '';
            return '<div class="flexDate_oper">' +
                (option.clearBtn ? '<a href="javascript:void(0);" >清空</a> ' : '') +
                (option.todayBtn ? '<a href="javascript:void(0);" >今天</a> ' : '') +
                (option.confirmBtn ? '<a href="javascript:void(0);" >确定</a>' : '') +
                '</div>';

        },
        tip: '<div class="flexDate_tip">' +
        '<b class="flexDate_tipBg"></b>' +
        '<p></p>' +
        '</div>',
        newYearCard: function (option, start) {
            var tag = '<ul class="flexDate_yearCard" >',
                thisYear = util.getCurYear(),
                selectedYear = util.getSelectedYear(option.value, option.format);
            for (var i = start; i < start + 16; i++) {
                tag += '<li class="' + (selectedYear == i ? 'flexDate_selected ' : ' ') + (thisYear == i ? 'flexDate_cur ' : '') +(util.compare(i,option.min,option.max)?'':'flexDate_disabled')+  '">' + i + '</li>';
            }
            tag += '</ul>';
            return tag;
        },
        newMonthCard: function (option, targetYear) {
            var tag = '<ul class="flexDate_monthCard">',
                thisYear = util.getCurYear(),
                selectedYear = util.getSelectedYear(option.value, option.format),
                thisMonth = util.getCurMonth(),
                selectedMonth = util.getSelectedMonth(option.value, option.format);
            for (var i = 1; i <= 12; i++) {
                tag += '<li class="' + (targetYear == selectedYear && selectedMonth == i ? 'flexDate_selected ' : ' ') + ((thisYear == targetYear) && thisMonth == i ? 'flexDate_cur ' : '') +(util.compare(targetYear+(i < 10 ? '0' + i : ''+i),option.min,option.max)?'':'flexDate_disabled')+ '" ><span>' + (i < 10 ? '0' + i : i) + '</span>月</li>';
            }
            tag += '</ul>';
            return tag;
        },
        newDateCard: function (option, year, month) {
            var thisLen = util.getMonthLength(year, month),
                preLen = util.getMonthLength(month > 1 ? year : year - 1, month != 1 ? month - 1 : 12),
                dayOfWeek = new Date(year + '/' + month + '/01').getDay(),
                preSul = dayOfWeek == 0 ? 7 : dayOfWeek,
                sufSul = 42 - thisLen - preSul;
            var selectedDate = util.getSelectedDate(option.value, option.format),
                thisDate = util.getCurDate(),
                isCurMonth = year == util.getCurYear() && month == util.getCurMonth(),
                isSelectedMonth = year == util.getSelectedYear(option.value, option.format) && month == util.getSelectedMonth(option.value, option.format),
                isPrevMonth = (month > 1 ? year : year - 1) == util.getCurYear() && (month > 1 ? month - 1 : 12) == util.getCurMonth(),
                isNextMonth = (month > 1 ? year : year + 1) == util.getCurYear() && (month > 1 ? month + 1 : 12) == util.getCurMonth(),
                i;
            var tag = '<div  class="flexDate_dateCard">' +
                '<ul>' +
                '<li>日</li>' +
                '<li>一</li>' +
                '<li>二</li>' +
                '<li>三</li>' +
                '<li>四</li>' +
                '<li>五</li>' +
                '<li>六</li>' +
                '</ul>' +
                '<ul>';
            var prevYearMonth=month > 1 ? year+''+(month-1<10?'0'+(month-1):month-1) : year - 1+''+12;
            var nextYearMonth=month != 12 ? year+''+(month+1<10?'0'+(month+1):month+1) : year + 1+'01';
            for (i = preLen - preSul + 1; i <= preLen; i++) {
                tag += '<li class="flexDate_others ' + (isPrevMonth && thisDate == i ? 'flexDate_cur ' : '') +(util.compare(prevYearMonth+(i < 10 ? '0' + i : i),option.min,option.max)?'':'flexDate_disabled')+ '">' + i + '</li>';
            }
            for (i = 1; i <= thisLen; i++) {
                tag += '<li class="' + (isSelectedMonth && selectedDate == i ? 'flexDate_selected ' : '') + (isCurMonth && thisDate == i ? 'flexDate_cur ' : '') +(util.compare(year+''+(month<10?'0'+month:month)+(i < 10 ? '0' + i : i),option.min,option.max)?'':'flexDate_disabled')+ '">' + i + '</li>';
            }
            for (i = 1; i <= sufSul; i++) {
                tag += '<li class="flexDate_others ' + (isNextMonth && thisDate == i ? 'flexDate_cur ' : '') +(util.compare(nextYearMonth+(i < 10 ? '0' + i : i),option.min,option.max)?'':'flexDate_disabled')+ '">' + i + '</li>';
            }
            tag += '</ul></div>';
            return tag;
        }
    };
    var event = {
        zIndex: 1,
        barLen: 130,
        bindEvent: function (option, page) {
            var me = this, $year = page.find('.flexDate_year>b'), $month = page.find('.flexDate_month>b'), timer;

            function showYearWrapper() {
                var yearW = page.find('>.flexDate_body>.flexDate_yearWrapper');
                if (yearW.is(':visible')) {
                    return;
                }
                yearW.css('zIndex', event.zIndex++).show();
                util.setDelay(function () {
                    yearW.siblings('.flexDate_monthWrapper,.flexDate_dateWrapper').hide();
                }, 500);
            }

            function showMonthWrapper() {
                var monthW = page.find('>.flexDate_body>.flexDate_monthWrapper');
                if (monthW.is(':visible')) {
                    return;
                }
                monthW.css('zIndex', event.zIndex++).show();
                util.setDelay(function () {
                    monthW.siblings('.flexDate_yearWrapper,.flexDate_dateWrapper').hide();
                }, 500);
            }

            function showDateWrapper() {
                var dateW = page.find('>.flexDate_body>.flexDate_dateWrapper');
                if (dateW.is(':visible')) {
                    return;
                }
                dateW.css('zIndex', event.zIndex++).show();
                util.setDelay(function () {
                    dateW.siblings('.flexDate_yearWrapper,.flexDate_monthWrapper').hide();
                }, 500);
            }

            //赋值和隐藏
            function assignAndHide(flag) {
                var date = util.toInt(page.find('.flexDate_dateWrapper .flexDate_selected').text()),
                    dateStr = date < 10 ? '0' + date : date,
                    hourStr = page.find('.flexDate_h').text(),
                    minuteStr = page.find('.flexDate_m').text(),
                    secondStr = page.find('.flexDate_s').text();
                if (flag === null) {//说明没有选定就点击确定
                    showTip('请先选定');
                    return;
                }
                var value;
                value = util.setSelectedValue(option.value, $year.text(), util.YEAR, option.format);
                $month.length > 0 ? value = util.setSelectedValue(value,$month.text(), util.MONTH, option.format) : 0;
                date ?value = util.setSelectedValue(value, dateStr, util.DATE, option.format) : 0;
                hourStr ? value = util.setSelectedValue(value, hourStr, util.HOUR, option.format) : 0;
                minuteStr && '--' != minuteStr ? value = util.setSelectedValue(value, minuteStr, util.MINUTE, option.format) : 0;
                secondStr && '--' != secondStr ?value = util.setSelectedValue(value, secondStr, util.SECOND, option.format) : 0;
                if(!util.compare(value,option.min,option.max)){
                    showTip('超过限定时间');
                    return;
                }
                option.value=value;
                page.parent().hide();
                $(option.e).val(flag === '' ? flag : option.value);

                if (flag === '') {//点击清除按钮
                    option.value = option.today;
                    me.option.confirm('');
                }else{
                    me.option.confirm(option.value);
                }
                redraw(me);
            }

            //设置bar的进度
            function setPro(percent) {
                page.find('.flexDate_pro').css({
                    width: event.barLen * percent,
                    transition: 'width 0.5s'
                }).next().css({
                    left: event.barLen * percent,
                    transition: 'left 0.5s'
                });
            }
            //显示提示
            function showTip(text) {
                var card = page.find('.flexDate_body>:visible>*');
                card.addClass('flexDate_shake');
                util.setDelay(function () {
                    card.removeClass('flexDate_shake');
                }, 500);
                var tip = page.children('.flexDate_tip');
                clearTimeout(timer);
                tip.children('p').text(text);
                tip.css({
                    display: 'block',
                    zIndex: event.zIndex++
                });
                timer = setTimeout(function () {
                    tip.hide();
                }, 2000);

            }

            page.on('click', '.flexDate_year', function () {//点击年份
                showYearWrapper();
            }).on('click', '.flexDate_month', function () {//点击月份
                showMonthWrapper();
            }).on('click', '.flexDate_lArrow', function () {//点击左箭头
                var sYear, sMonth, tYear, tMonth,
                    wrapper = page.find('.flexDate_body>:visible');
                if (wrapper.hasClass('flexDate_yearWrapper')) {
                    var start = Number(page.find('.flexDate_yearCard:eq(0)>li:eq(0)').text()) - 16;
                    var yearCard = page.find('.flexDate_yearWrapper').prepend(html.newYearCard(option, start)).children('.flexDate_yearCard:eq(0)').addClass('flexDate_left2Right');
                    util.setDelay(function () {
                        yearCard.removeClass('flexDate_left2Right').nextAll().remove();
                    }, 500);
                } else if (wrapper.hasClass('flexDate_monthWrapper')) {
                    tYear = Number($year.text()) - 1;
                    var monthCard = page.find('.flexDate_monthWrapper').prepend(html.newMonthCard(option, tYear)).children('.flexDate_monthCard:eq(0)').addClass('flexDate_left2Right');
                    $year.text(tYear);
                    util.setDelay(function () {
                        monthCard.removeClass('flexDate_left2Right').nextAll().remove();
                    }, 500);
                } else {
                    sYear = Number($year.text()),
                        sMonth = Number($month.text()),
                        tYear = sMonth > 1 ? sYear : sYear - 1,
                        tMonth = sMonth > 1 ? sMonth - 1 : 12;
                    var dateCard = page.find('.flexDate_dateWrapper').prepend(html.newDateCard(option, tYear, tMonth)).children('.flexDate_dateCard:eq(0)').addClass('flexDate_left2Right');
                    $year.text(tYear);
                    $month.text(tMonth < 10 ? '0' + tMonth : tMonth);
                    util.setDelay(function () {
                        dateCard.removeClass('flexDate_left2Right').nextAll().remove();
                    }, 500);
                }
            }).on('click', '.flexDate_rArrow', function () {//点击右箭头
                var $year, $month, sYear, sMonth, tYear, tMonth,
                    wrapper = page.find('.flexDate_body>:visible');
                if (wrapper.hasClass('flexDate_yearWrapper')) {
                    var start = Number(page.find('.flexDate_yearCard:eq(0)>li:last-child').text()) + 1;
                    page.find('.flexDate_yearWrapper').append(html.newYearCard(option, start)).children('.flexDate_yearCard:eq(0)').addClass('flexDate_right2Left').on('animationend webkitAnimationEnd oAnimationEnd', function () {
                        page.find('.flexDate_yearCard:last-child').prevAll().remove();
                    });
                    util.supportAnim() || page.find('.flexDate_yearCard:last-child').prevAll().remove();
                } else if (wrapper.hasClass('flexDate_monthWrapper')) {
                    $year = page.find('.flexDate_year>b'),
                        tYear = Number($year.text()) + 1;
                    page.find('.flexDate_monthWrapper').append(html.newMonthCard(option, tYear)).children('.flexDate_monthCard:eq(0)').addClass('flexDate_right2Left').on('animationend webkitAnimationEnd oAnimationEnd', function () {
                        page.find('.flexDate_monthCard:last-child').prevAll().remove();
                    });
                    $year.text(tYear);
                    util.supportAnim() || page.find('.flexDate_monthCard:last-child').prevAll().remove();
                } else {
                    $year = page.find('.flexDate_year>b'),
                        $month = page.find('.flexDate_month>b'),
                        sYear = Number($year.text()),
                        sMonth = Number($month.text()),
                        tYear = sMonth < 12 ? sYear : sYear + 1,
                        tMonth = sMonth < 12 ? sMonth + 1 : 1;
                    page.find('.flexDate_dateWrapper').append(html.newDateCard(option, tYear, tMonth)).children('.flexDate_dateCard:eq(0)').addClass('flexDate_right2Left').on('animationend webkitAnimationEnd oAnimationEnd', function () {
                        page.find('.flexDate_dateCard:last-child').prevAll().remove();
                    });
                    $year.text(tYear);
                    $month.text(tMonth < 10 ? '0' + tMonth : tMonth);
                    util.supportAnim() || page.find('.flexDate_dateCard:last-child').prevAll().remove();
                }
            }).on('click', '.flexDate_yearCard>li', function () {//选择年份
                var clickYear = Number($(this).text()), month;
                if($(this).hasClass('flexDate_disabled'))return;
                $year.text(clickYear);
                $(this).addClass('flexDate_selected').siblings().removeClass('flexDate_selected');
                if ('year' == option.type) {
                    assignAndHide();
                } else if ('month' == option.type) {
                    page.find('.flexDate_monthWrapper').html(html.newMonthCard(option, clickYear));
                    showMonthWrapper();
                } else {
                    month = Number($month.text());
                    page.find('.flexDate_monthWrapper').html(html.newMonthCard(option, clickYear));
                    page.find('.flexDate_dateWrapper').html(html.newDateCard(option, clickYear, month));
                    showDateWrapper();
                }

            }).on('click', '.flexDate_monthCard>li', function () {//选择月份
                var monthStr = $(this).children().text(),
                    clickMonth = Number($(this).children().text());
                if($(this).hasClass('flexDate_disabled'))return;
                $month.text(monthStr);
                $(this).addClass('flexDate_selected').siblings().removeClass('flexDate_selected');
                if ('month' == option.type) {
                    assignAndHide();
                } else {
                    page.find('.flexDate_dateWrapper').html(html.newDateCard(option, $year.text(), clickMonth));
                    showDateWrapper();
                }
            }).on('click', '.flexDate_dateCard>ul:eq(1)>li', function () {//选择日
                if($(this).hasClass('flexDate_disabled'))return;
                if ($(this).hasClass('flexDate_others')) {//点击到了其他月份的日
                    var date = Number($(this).text()),
                        month = Number($month.text()),
                        nextMonth = month == 12 ? 1 : month + 1,
                        prevMonth = month == 1 ? 12 : month - 1,
                        year = Number($year.text());
                    if (date < 11) {//下一个月份的日
                        $month.text(nextMonth < 10 ? '0' + nextMonth : nextMonth);
                        $year.text(month == 12 ? year + 1 : year);
                    } else {//上一个月份的日
                        $month.text(prevMonth < 10 ? '0' + prevMonth : prevMonth);
                        $year.text(month == 1 ? year - 1 : year);
                    }
                    page.find('.flexDate_dateWrapper').html(html.newDateCard(option, $year.text(), $month.text())).find('.flexDate_dateCard>ul:eq(1)>li:not(.flexDate_others)').removeClass('flexDate_selected').each(function () {

                        if ($(this).text() == date) {
                            $(this).addClass('flexDate_selected');
                        }
                    });
                } else {
                    $(this).addClass('flexDate_selected').siblings().removeClass('flexDate_selected');
                }
                assignAndHide();
            }).on('mousedown', '.flexDate_ball', function () {//鼠标按下ball
                var self = this, disX = $(this).parent().offset().left, scale;
                var target = $(this).parents('.flexDate_timePicker').prev().children('.flexDate_slide');
                $(this).css('transition', 'none').prev().css('transition', 'none');
                if (target.hasClass('flexDate_h')) {
                    scale = 23 / event.barLen;
                } else {
                    scale = 59 / event.barLen;
                }
                function mousemove(e) {
                    var left = e.clientX + $(window).scrollLeft() - disX, value;
                    window.getSelection ? window.getSelection().removeAllRanges() : document.selection.empty();
                    if (left < 0) {
                        left = 0;
                    } else if (left > event.barLen) {
                        left = event.barLen;
                    }
                    $(self).css('left', left).prev().css('width', left);
                    value = Math.round(left * scale);
                    target.text(value < 10 ? '0' + value : value);

                }

                function mouseup() {
                    $(document).off('mousemove', mousemove).off('mouseup', mouseup);
                }

                $(document).on('mousemove', mousemove).on('mouseup', mouseup);
            }).on('click', '.flexDate_timeShow>span', function () {//点击切换时分秒
                if ('--' == $(this).text()) {
                    return;
                }
                $(this).addClass('flexDate_slide').siblings().removeClass('flexDate_slide');
                if ($(this).hasClass('flexDate_h')) {
                    setPro($(this).text() / 23);
                } else {
                    setPro($(this).text() / 59);
                }
            }).on('click', '.flexDate_bar', function (e) {//点击 bar 快速定位ball
                var target = $(this).parent().prev().children('.flexDate_slide'), scale, value;
                if (target.hasClass('flexDate_h')) {
                    scale = 23 / event.barLen;
                } else {
                    scale = 59 / event.barLen;
                }
                if ($(e.target).hasClass('flexDate_bar') || $(e.target).hasClass('flexDate_pro')) {
                    var left = e.clientX + $(window).scrollLeft() - $(this).offset().left;
                    value = Math.round(left * scale);
                    target.text(value < 10 ? '0' + value : value);
                    setPro(left / event.barLen);
                }
            }).on('click', '.flexDate_oper>a:contains(清空)', function () {
                assignAndHide('');
            }).on('click', '.flexDate_oper>a:contains(今天)', function () {
                var dateObj = new Date(), date = util.getCurDate(dateObj), $hour = page.find('.flexDate_h'), $minute = page.find('.flexDate_m'), $second = page.find('.flexDate_s');
                if(!util.compare(util.getToday(option.format, dateObj),option.min,option.max)){
                    showTip('超过限定时间');
                    return;
                }
                $year.text(util.getCurYear());
                $month.text(util.getCurMonthStr());
                page.find('.flexDate_dateWrapper li:not(flexDate_others)').each(function () {
                    if ($(this).text() == date) {
                        $(this).addClass('flexDate_selected').siblings().removeClass('flexDate_selected');
                        return false;
                    }
                });
                $hour.text(util.getCurHourStr(dateObj));
                $minute.text() == '--' || $minute.text(util.getCurMinuteStr(dateObj));
                $second.text() == '--' || $second.text(util.getCurSecondStr(dateObj));
                option.value = util.getToday(option.format, dateObj);
                assignAndHide();
            }).on('click', '.flexDate_oper>a:contains(确定)', function () {
                if (page.find('.flexDate_body>:visible .flexDate_selected').length != 0) {
                    assignAndHide();
                } else {
                    assignAndHide(null);
                }

            });
            if(option.bindClick){
                $(option.e).click(function () {
                    me.show();
                }).on('mousedown', function (e) {
                    e.stopPropagation();
                });
            }

            //阻止事件冒泡到document
            page.parent().on('mousedown', function (e) {
                e.stopPropagation();
            });
            $(document).mousedown(function () {
                $('.flexDate_container').hide();
            })
        }
    };
    $(function () {//扫描文档初始化日期
        $('.flexDate').each(function () {
            var target=$(this);
            var confirm=window[target.attr('confirm')];
            var value=this.value;
            var min=target.attr('min');
            var max=target.attr('max');
            var option = {
                e: this,
                value: /Date/g.test(value)?eval(value):value,
                format: target.attr('format'),
                clearBtn: eval(target.attr('clearBtn')),
                todayBtn: eval(target.attr('todayBtn')),
                confirmBtn: eval(target.attr('confirmBtn')),
                min:/Date/g.test(min)?eval(min):min,
                max:/Date/g.test(max)?eval(max):max,
                zIndex:target.attr('zIndex'),
                bindClick:eval(target.attr('bindClick')),
                confirm:confirm?confirm:function(){}
            };
            new FlexDate(option);
        })
    });
    window.FlexDate = FlexDate;
})(jQuery);