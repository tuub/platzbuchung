import moment from "moment-timezone";

function formatDate(value) {
    if (value) {
        return moment(value).format('DD.MM.YYYY');
    }
    return '---';
}

function formatDateWithWeekday(value) {
    if (value) {
        return moment(value).format('dd, DD.MM.YYYY');
    }
    return '---';
}

function formatDateForUri(value) {
    if (value) {
        return moment(value).format('YYYY-MM-DD');
    }
    return '---';
}

function formatTimeString(value) {
    if (value) {
        return moment(value, 'H:mm:ss').format('H:mm');
    }
    return '---';
}

function formatDateTimeString(value) {
    if (value) {
        return moment(value).format('H:mm');
    }
    return '---';
}

function formatWeekDay(value) {
    if (value) {
        return moment().day(value).format('dddd');
    }
    return '---';
}

function formatImageUri(value, x, y) {
    if (value) {
        return '<img src="' + value + '" style="width: ' + x + 'px">';
    }
    return '---';
}

export default {
    formatDate: formatDate,
    formatDateWithWeekday: formatDateWithWeekday,
    formatDateForUri: formatDateForUri,
    formatTimeString: formatTimeString,
    formatDateTimeString: formatDateTimeString,
    formatWeekDay: formatWeekDay,
    formatImageUri: formatImageUri,
}
