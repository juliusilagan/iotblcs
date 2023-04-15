const { TextDecoder } = require('text-encoding')
const { chunk } = require('./chunk')
const { charset } = require('../charset')
const { splitNonetIntoFields, Octet, Field } = require('./binary')

const codePointToNonet = [...charset]
  .reduce((map, emoji, index) => map.set(
    emoji.codePointAt(0),
    index
  ), new Map())

function decode (encoded) {
  const fields = []

  for (const emoji of chunk.call(encoded, 8)) {
    const codepoints = emoji.map((emoji) => emoji.codePointAt(0))
    const nonets = codepoints.map((codepoint) => codePointToNonet.get(codepoint))

    let suffix

    if (nonets[nonets.length - 1] > 2 ** 9 - 1) {
      suffix = nonets.pop()
    }

    if (nonets.length !== 0) fields.push(new Field(0, 0))

    nonets.forEach((nonet, index) => {
      const head = 8 - index
      const tail = index + 1
      const halves = splitNonetIntoFields(nonet, head, tail)
      fields.push(...halves)
    })

    if (suffix) {
      fields.pop()
      if (nonets.length === 0) {
        fields.pop()
      }
    } else {
      fields.push(new Field(0, 0))
    }
  }

  const octets = []
  for (const [first, second] of chunk.call(fields, 2)) {
    const octet = new Octet(first, second)
    octets.push(octet.value)
  }

  return new Uint8Array(octets)
}

function decodeText (data, encoding) {
  return new TextDecoder(encoding).decode(decode(data))
}

module.exports = { decode, decodeText }
