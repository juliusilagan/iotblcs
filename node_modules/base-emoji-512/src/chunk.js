// Source: wu.js
// https://www.npmjs.com/package/wu

module.exports.chunk = function* (n = 2) {
  let items = []
  let index = 0

  for (let item of this) {
    items[index++] = item
    if (index === n) {
      yield items
      items = []
      index = 0
    }
  }

  if (index) {
    yield items
  }
}
