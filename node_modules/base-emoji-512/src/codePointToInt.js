module.exports.codePointToInt = function (codepoint) {
  const hex = codepoint.substring(2)
  const dec = parseInt(hex, 16)
  return dec
}
