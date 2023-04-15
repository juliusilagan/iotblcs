const { writeFileSync } = require('fs')
const { join } = require('path')
const { symbols } = require('./symbols')

const destination = join(__dirname, '..', 'charset.js')
const characters = symbols.map(({text}) => text)
const code = `module.exports.charset = '${characters.join('')}'\n`
writeFileSync(destination, code)
