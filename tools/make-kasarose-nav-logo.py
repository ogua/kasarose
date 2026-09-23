"""
Generate a "KASAROSE"-only horizontal lockup for the main nav / offcanvas-nav header,
which want the short form of the name rather than the full "KASAROSE LOGISTICS" lockup.

The "KASAROSE" wordmark already exists as the top band of
images/kasarose-logistics-wordmark(-white).png (rows 0-91 of a 177px-tall canvas;
"LOGISTICS" sits in rows 120-174, in grey/white beneath it) — this just crops that
band out and re-composes it next to the existing K icon at a scale suited to a
single line of text (rather than the two-line stack the full lockup uses).

This does NOT touch the full "KASAROSE LOGISTICS" lockup used everywhere else
(footer, canvas-menu, schema.org, og:image, the roster logo) — see CLAUDE.md,
those stay the full name. Only the nav/offcanvas-nav header logo uses this output.

Run from the repo root:  python tools/make-kasarose-nav-logo.py
"""
from PIL import Image
import numpy as np

WORDMARK = 'images/kasarose-logistics-wordmark.png'
WORDMARK_WHITE = 'images/kasarose-logistics-wordmark-white.png'
ICON = 'images/kasarose-icon.png'
ICON_WHITE = 'images/kasarose-icon-white.png'
OUT = 'images/'

KASAROSE_BAND = (0, 92)  # rows of the "KASAROSE" line alone, measured off the source


def kasarose_word(path):
    a = np.array(Image.open(path).convert('RGBA'))
    band = a[KASAROSE_BAND[0]:KASAROSE_BAND[1]]
    alpha = band[..., 3]
    xs = np.where(alpha.max(axis=0) > 8)[0]
    return Image.fromarray(band[:, xs.min():xs.max() + 1], 'RGBA')


def lockup_h(icon, word, scale=1.55, gap=28):
    h = int(word.height * scale)
    ic = icon.resize((int(icon.width * h / icon.height), h), Image.LANCZOS)
    W, H = ic.width + gap + word.width, max(ic.height, word.height)
    im = Image.new('RGBA', (W, H), (0, 0, 0, 0))
    im.alpha_composite(ic, (0, (H - ic.height) // 2))
    im.alpha_composite(word, (ic.width + gap, (H - word.height) // 2))
    return im


def main():
    word = kasarose_word(WORDMARK)
    word_white = kasarose_word(WORDMARK_WHITE)
    icon = Image.open(ICON).convert('RGBA')
    icon_white = Image.open(ICON_WHITE).convert('RGBA')

    assets = {
        'kasarose-wordmark.png': word,
        'kasarose-wordmark-white.png': word_white,
        'kasarose-logo-h.png': lockup_h(icon, word),
        'kasarose-logo-h-white.png': lockup_h(icon_white, word_white),
    }
    for name, im in assets.items():
        im.save(OUT + name)
        print(f'{name:34s} {im.size[0]}x{im.size[1]}')


if __name__ == '__main__':
    main()
