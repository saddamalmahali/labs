export function getHourTime (h) {
  return h >= 12 ? 'PM' : 'AM'
}

export function getZeroPad (n) {
  return parseInt(n, 10) >= 10 ? n : ('0' + n + '')
}
