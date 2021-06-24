const dt = luxon.DateTime;
function formatDate(dateString = '', format = '') {
  return dt.fromSQL(dateString).setLocale('id').toLocaleString(format);
}

function formatTime(timeString = '') {
  return dt.fromSQL(timeString).setLocale('id').toLocaleString(dt.TIME_24_SIMPLE);
}