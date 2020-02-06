# Creating EAN13 barcode in PHP or JS, using a font

The ean13 font can be used to render ean13 encoded strings.

as there is no special string encoding defined for EAN/GTIN i made it up myself.

[live example](https://cdn.rawgit.com/Holger-Will/ean13-font/f64783473ff959cf37bd87e2c263acb40b4aea6b/examples/generator.html)

you can create your own font using the  [barcode-font-generator](https://github.com/Holger-Will/barcode-font-generator)

## install



## usage

Encoding is done with the following schema: (example 4054503008694; the last Digit 4 is the checksum)

the first digit is just written with an underscore `_4` followed by the startcode `*`
then you lookup the even/uneven pattern from this table, base on the first digit (4)

| digit | pattern |
| --- | --- |
| 0 | LLLLLL |
| 1 | LLGLGG |
| 2 | LLGGLG |
| 3 | LLGGGL |
| 4 | LGLLGG |
| 5 | LGGLLG |
| 6 | LGGGLL |
| 7 | LGLGLG |
| 8 | LGLGGL |
| 9 | LGGLGL |

so in our case the pattern is `LGLLGG`
next you write the digits 2 to 7 (`054503`) prefixed with the corresponding letter from the pattern

`L0G5L4L5G0G3` followed by the mid-stop marker `**`.

the remaining digits are just prefixed with `R`: `R0R0R8R6R9R4` and then the whole code ends with the stop code `*`

so the encoded string now looks like this:

    _4*L0G5L4L5G0G3**R0R0R8R6R9R4*

when you display this string with the ean13 font, it will produce a nicely scannable barcode.

see the [example generator](https://cdn.rawgit.com/Holger-Will/ean13-font/f64783473ff959cf37bd87e2c263acb40b4aea6b/examples/generator.html)
