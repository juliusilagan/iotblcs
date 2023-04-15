# base-emoji-512

An emoji-based alternative to Base64 encoding of text and binary data.

Uses 512 unique emoji as the charcter set, plus another 8 as padding suffix.

Encodes every 9 octets (8 bits) into 8 nonets (9 bits). This introduces bit-wrapping: an interesting visual effect that causes all of the emoji character set to be used. Even within a limited range of values, like most plain text.

## Examples

```js
import {encode} from 'base-emoji-512'

encode('OMG emoji!')
// "🙌🌿😱😆💖🍘🎪👲😈🕒"

const file = path.join(__dirname, 'README.md')
const buffer = fs.readFileSync(file)
encode(buffer)
// "💀🏋🐲😏🙅🍄💜🍰🐵🌁🍆💅🍆👩🐊👱📿🚅🍕🖖🌅👎💣🍥👗🏋🐥👖💪🍙🍁🕵🐅🗽🎢🙀..."
```

```js
import {decode, decodeText} from 'base-emoji-512'

decode('🚅💌⏱🐄🕟')
// Uint8Array [ 0xDE, 0xAD, 0xBE, 0xEF ]

decodeText('🎒🚜🍼🍓💗💪🐇🕕')
// "hunter2"
```

## Emoji

### Encoded Characters (512)

😀😁😂😃😄😅😆😉😊😋😎😍😘😗😙😚🙂🤗🤔😐😑😶🙄😏😣😥😮🤐😯😪😫😴😌🤓😛😜😝😒😓😔😕🙃🤑😲🙁😖😞😟😤😢😭😦😧😨😩😬😰😱😳😵😡😠😇😷🤒🤕😈👿👹👺💀👻👽👾🤖💩😺😸😹😻😼😽🙀😿😾🙈🙉🙊👦👧👨👩👴👵👶👼👮🕵💂👷👳👱🎅👸👰👲🙍🙎🙅🙆💁🙋🙇💆💇🚶🏃💃👯🕴🗣👤👥🏇🏂🏌🏄🚣🏊🏋🚴🚵🏎🏍👫👬👭💏💑👪💪👈👉👆🖕👇🖖🤘🖐✋👌👍👎✊👊👋👏👐🙌🙏💅👂👃👣👀👁👅👄💋💘💓💔💕💖💗💙💚💛💜💝💞💟💌💤💢💣💥💦💨💫💬🗨🗯💭🕳👓🕶👔👕👖👗👘👙👚👛👜👝🛍🎒👞👟👠👡👢👑👒🎩🎓📿💄💍💎🐵🐒🐶🐕🐩🐺🐱🐈🦁🐯🐅🐆🐴🐎🦄🐮🐂🐃🐄🐷🐖🐗🐽🐏🐑🐐🐪🐫🐘🐭🐁🐀🐹🐰🐇🐿🐻🐨🐼🐾🦃🐔🐓🐣🐤🐥🐦🐧🕊🐸🐊🐢🐍🐲🐉🐳🐋🐬🐟🐠🐡🐙🐚🦀🐌🐛🐜🐝🐞🕷🕸🦂💐🌸💮🏵🌹🌺🌻🌼🌷🌱🌲🌳🌴🌵🌾🌿🍀🍁🍂🍃🍇🍈🍉🍊🍋🍌🍍🍎🍏🍐🍑🍒🍓🍅🍆🌽🌶🍄🌰🍞🧀🍖🍗🍔🍟🍕🌭🌮🌯🍳🍲🍿🍱🍘🍙🍚🍛🍜🍝🍠🍢🍣🍤🍥🍡🍦🍧🍨🍩🍪🎂🍰🍫🍬🍭🍮🍯🍼🍵🍶🍾🍷🍸🍹🍺🍻🍽🍴🔪🏺🌍🌎🌏🌐🗺🗾🏔🌋🗻🏕🏖🏜🏝🏞🏟🏛🏗🏘🏙🏚🏠🏡🏢🏣🏤🏥🏦🏨🏩🏪🏫🏬🏭🏯🏰💒🗼🗽🕌🕍🕋🌁🌃🌄🌅🌆🌇🌉🌌🎠🎡🎢💈🎪🎭🖼🎨🎰🚂🚃🚄🚅🚆🚇🚈🚉🚊🚝🚞🚋🚌🚍🚎🚐🚑🚒🚓🚔🚕🚖🚗🚘🚙🚚🚛🚜🚲🚏🛣🛤🚨🚥🚦🚧🚤🛳🛥🚢🛩🛫🛬💺🚁🚟🚠🚡🚀🛰🛎🚪🛌🛏🛋🚽🚿🛀🛁⏳⏰⏱⏲🕰🕛🕧🕐🕜🕑🕝

### Termination Padding (8)

🕒🕞🕓🕟🕔🕠🕕🕡

## Installation

```
npm install --save base-emoji-512
```

## API

### encode(data: String|TypedArray): String

Pass data as either a String or a TypedArray (e.g. Buffer).

Returns synchronously with a deterministic string encoding the input as emoji.

### decode(emoji: String): Uint8Array

Returns the binary data represented by the `emoji` string as a TypedArray.

### decodeText(emoji: String, encoding?: String): String

Convenience method that passes the decoded buffer into [TextDecoder](https://developer.mozilla.org/en-US/docs/Web/API/TextDecoder).

`emoji` is a string as created by `encode()`.

Optionally, `encoding` can be `utf-8` (default), `utf-16le`, or `utf-16be`.

## See Also

- [npm:base-emoji](https://www.npmjs.com/package/base-emoji) - Only supports 256 emoji and does not wrap which means plain text is limited to a very small number of repetitive emoji.

## Colophon

Made with :heart: by Sebastiaan Deckers in Singapore.
