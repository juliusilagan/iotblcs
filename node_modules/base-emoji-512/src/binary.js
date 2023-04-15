class Field {
  constructor (bits, length) {
    this.bits = bits
    this.length = length
  }

  toString () {
    return this.length === 0
      ? ''
      : this.bits.toString(2).padStart(this.length, '0')
  }
}

class Bits {
  constructor (first, second) {
    this.width = 0

    if (!first) throw Error('Missing first half')
    if (!second) throw Error('Missing second half')

    this.first = first
    this.second = second
  }

  get value () {
    return (this.first.bits << (this.width - this.first.length)) |
      this.second.bits
  }

  toString () {
    return this.first.toString() + ' ' +
      this.second.toString() + ' = ' +
      ('0x' + this.value.toString(16)).padStart(5, ' ') + ' ' +
      this.value.toString(10).padStart(5, ' ')
  }
}

class Octet extends Bits {
  constructor () {
    super(...arguments)
    this.width = 8
  }
}

class Nonet extends Bits {
  constructor () {
    super(...arguments)
    this.width = 9
  }
}

function splitBitsIntoFields (length, bits, head, tail) {
  const upperBound = (1 << length) - 1

  const headMask = (upperBound << (length - head)) & upperBound
  const headMasked = bits & headMask
  const headValue = headMasked >> (length - head)
  const first = new Field(headValue, head)

  const tailMask = (upperBound >> (length - tail)) & upperBound
  const tailMasked = bits & tailMask
  const second = new Field(tailMasked, tail)

  return [first, second]
}

module.exports = {
  Field,
  Bits,
  Octet,
  Nonet,
  splitBitsIntoFields,
  splitOctetIntoFields: splitBitsIntoFields.bind(undefined, 8),
  splitNonetIntoFields: splitBitsIntoFields.bind(undefined, 9)
}
