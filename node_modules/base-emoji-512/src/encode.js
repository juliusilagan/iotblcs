const { TextEncoder } = require('text-encoding')
const { chunk } = require('./chunk')
const { charset } = require('../charset')

const characters = [...charset]

module.exports.encode = function (data) {
  const unencoded =
    typeof data === 'string' ? new TextEncoder('utf-8').encode(data)
    : data && data.buffer instanceof ArrayBuffer ? new Uint8Array(data.buffer)
    : undefined

  if (!unencoded) throw Error('Input must be a String or TypedArray')

  let encoded = ''
  let suffix = ''

  for (const octets of chunk.call(unencoded, 9)) {
    const nonets = []

    if (octets.length >= 8) {
      nonets.push(((octets[7] & 0b00000001) << 8) + (octets[8] >> 0))
    }
    if (octets.length >= 7) {
      nonets.push(((octets[6] & 0b00000011) << 7) + (octets[7] >> 1))
    }
    if (octets.length >= 6) {
      nonets.push(((octets[5] & 0b00000111) << 6) + (octets[6] >> 2))
    }
    if (octets.length >= 5) {
      nonets.push(((octets[4] & 0b00001111) << 5) + (octets[5] >> 3))
    }
    if (octets.length >= 4) {
      nonets.push(((octets[3] & 0b00011111) << 4) + (octets[4] >> 4))
    }
    if (octets.length >= 3) {
      nonets.push(((octets[2] & 0b00111111) << 3) + (octets[3] >> 5))
    }
    if (octets.length >= 2) {
      nonets.push(((octets[1] & 0b01111111) << 2) + (octets[2] >> 6))
    }
    if (octets.length >= 1) {
      nonets.push(((octets[0] & 0b11111111) << 1) + (octets[1] >> 7))
    }

    if (octets.length < 9) {
      suffix = characters[2 ** 9 + octets.length - 1]
    }

    for (let i = nonets.length; i--;) {
      encoded += characters[nonets[i]]
    }
  }

  // 2**8 is so much easier :'(
  // unencoded.forEach((octet) => encoded += characters[octet])

  return encoded + suffix
}
