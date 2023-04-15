const { emojis } = require('./emojis')
const { codePointToInt } = require('./codePointToInt')

const modifiers = [
  // skin tones
  'U+1F3FB', 'U+1F3FC', 'U+1F3FD', 'U+1F3FE', 'U+1F3FF'
]
  .map(codePointToInt)

function isSimple (emoji) {
  return emoji.codepoints.length === 1
}

function isPicture (emoji) {
  return !modifiers.includes(emoji.codepoints[0])
}

function isPrettyOnMacOs (emoji) {
  return emoji.version >= 6 && emoji.version < 9
}

const symbols = emojis
  .filter(isSimple)
  .filter(isPicture)
  .filter(isPrettyOnMacOs)
  .slice(0, 2 ** 9 + 8)

module.exports.symbols = symbols
