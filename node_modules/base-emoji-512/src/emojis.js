const { readFileSync } = require('fs')
const { join } = require('path')
const { codePointToInt } = require('./codePointToInt')

const source = join(__dirname, '..', 'emoji-ordering.txt')

const emojis = readFileSync(source, 'utf8')
  .split('\n')
  .map((line) => line.trim())
  .filter((line) => line.length && !line.startsWith('#'))
  .map((line) => {
    const emoji = Object.create(null)

    if (line.includes('#')) {
      const marker = line.indexOf('#')
      const comment = line.substring(marker + 1).trimLeft()
      emoji.label = comment.substring(comment.indexOf(' ') + 1).trimLeft()
      line = line.substring(0, marker).trimRight()
    }

    if (line.includes(';')) {
      const marker = line.indexOf(';')
      emoji.version = line.substring(marker + 1).trimLeft()
      line = line.substring(0, marker).trimRight()
    }

    if (line.length) {
      emoji.codepoints = line.split(/\s+/).map(codePointToInt)

      emoji.text = String.fromCodePoint(...emoji.codepoints)
    }

    return emoji
  })

module.exports.emojis = emojis
