"""
Generate the KROSEMARKET logo family.

KROSEMARKET is the group's ecommerce marketplace. Its logo is built from the
KASAROSE brand assets so the two read as one family:

  * the K mark is lifted unchanged from images/kasarose-logo.png (blue K with
    the red sliver — the marketplace's colourway, as opposed to the parent's navy);
  * the letters K R O S E A are the real KASAROSE letterforms, cut straight out
    of that logo's wordmark, so the face matches exactly;
  * M and T do not occur in "KASAROSE", so they are drawn here to the measured
    metrics of that face (cap height 119, stem 30, corner radius 4).

Colour split mirrors the parent lockup (black wordmark + red accent):
"KROSE" black, "MARKET" in the mark's red.

Run from the repo root:  python tools/make-krosemarket-logo.py
"""
from PIL import Image, ImageDraw
import numpy as np

SRC = 'images/kasarose-logo.png'
OUT = 'images/'

CAP, STEM, RADIUS, SS = 119, 30, 4, 4      # metrics measured off the source wordmark
WORD_BAND = (538, 658)                     # rows of the wordmark in the source
MARK_BAND = (50, 438)                      # rows of the K mark in the source

BLACK = (17, 17, 17)
RED   = (239, 65, 54)
BLUE  = (5, 95, 156)
WHITE = (255, 255, 255)

# x-ranges of the letters we can reuse (K = its stem plus its detached arm)
SPANS = {'K': (50, 165), 'S': (298, 405), 'A': (412, 547),
         'R': (556, 671), 'O': (685, 812), 'E': (950, 1051)}

WORD, SPLIT = 'KROSEMARKET', 5             # KROSE | MARKET
GAP = 13


def _trim(arr):
    ys = np.where(arr.max(axis=1) > 8)[0]
    xs = np.where(arr.max(axis=0) > 8)[0]
    return arr[ys.min():ys.max() + 1, xs.min():xs.max() + 1]


def source_glyphs(a):
    band = a[WORD_BAND[0]:WORD_BAND[1], :, 3]
    return {c: Image.fromarray(_trim(band[:, x0:x1]), 'L') for c, (x0, x1) in SPANS.items()}


def draw_T(w=106, h=CAP, s=STEM, r=RADIUS):
    im = Image.new('L', (w * SS, h * SS), 0)
    d = ImageDraw.Draw(im)
    d.rounded_rectangle([0, 0, w * SS - 1, s * SS - 1], radius=r * SS, fill=255)
    x = ((w - s) // 2) * SS
    d.rounded_rectangle([x, 0, x + s * SS - 1, h * SS - 1], radius=r * SS, fill=255)
    return im.resize((w, h), Image.LANCZOS)


def draw_M(w=150, h=CAP, s=STEM, d_=33, vy=82, r=RADIUS):
    """Two stems plus a mitred V — the pointed vertex echoes the face's A apex."""
    im = Image.new('L', (w * SS, h * SS), 0)
    dr = ImageDraw.Draw(im)
    dr.rounded_rectangle([0, 0, s * SS - 1, h * SS - 1], radius=r * SS, fill=255)
    dr.rounded_rectangle([(w - s) * SS, 0, w * SS - 1, h * SS - 1], radius=r * SS, fill=255)
    cx, a1 = w / 2, s / 2
    dx, dy = cx - a1, float(vy)
    th = d_ * ((dx * dx + dy * dy) ** 0.5) / dy     # horizontal width of the diagonal
    iv = (cx - (a1 + th)) * (dy / dx)               # depth of the inner vertex
    pts = [(a1, 0), (cx, vy), (w - a1, 0), (w - a1 - th, 0), (cx, iv), (a1 + th, 0)]
    dr.polygon([(x * SS, y * SS) for x, y in pts], fill=255)
    return im.resize((w, h), Image.LANCZOS)


def wordmark(g, dark, accent):
    width = sum(g[c].width for c in WORD) + GAP * (len(WORD) - 1)
    im = Image.new('RGBA', (width, CAP), (0, 0, 0, 0))
    x = 0
    for i, c in enumerate(WORD):
        m = g[c]
        layer = Image.new('RGBA', m.size, (dark if i < SPLIT else accent) + (255,))
        layer.putalpha(m)
        im.alpha_composite(layer, (x, CAP - m.height))
        x += m.width + GAP
    return im


def whiten_mark(mark):
    """Dark-background variant: the K goes white, the red sliver stays red —
    the same treatment as images/kasarose-logistics-logo-h-white.png."""
    a = np.array(mark).astype(int)
    r, g, b = a[..., 0], a[..., 1], a[..., 2]
    is_red = (r > 150) & (g < 130) & (b < 130)
    out = a.copy()
    out[..., :3] = np.where(is_red[..., None], a[..., :3], 255)
    return Image.fromarray(out.astype(np.uint8), 'RGBA')


def lockup_h(mark, word, scale=2.55, gap=46):
    h = int(CAP * scale)
    mk = mark.resize((int(mark.width * h / mark.height), h), Image.LANCZOS)
    W, H = mk.width + gap + word.width, max(mk.height, word.height)
    im = Image.new('RGBA', (W, H), (0, 0, 0, 0))
    im.alpha_composite(mk, (0, (H - mk.height) // 2))
    im.alpha_composite(word, (mk.width + gap, (H - word.height) // 2))
    return im


def lockup_stacked(mark, word, scale=3.25, gap=90):
    h = int(CAP * scale)
    mk = mark.resize((int(mark.width * h / mark.height), h), Image.LANCZOS)
    W, H = max(mk.width, word.width), mk.height + gap + word.height
    im = Image.new('RGBA', (W, H), (0, 0, 0, 0))
    im.alpha_composite(mk, ((W - mk.width) // 2, 0))
    im.alpha_composite(word, ((W - word.width) // 2, mk.height + gap))
    return im


def main():
    a = np.array(Image.open(SRC).convert('RGBA'))
    g = source_glyphs(a)
    g['M'], g['T'] = draw_M(), draw_T()

    mark = Image.fromarray(_trim_rgba(a[MARK_BAND[0]:MARK_BAND[1]]), 'RGBA')
    mark_w = whiten_mark(mark)

    word = wordmark(g, BLACK, RED)
    word_w = wordmark(g, WHITE, RED)

    assets = {
        'krosemarket-wordmark.png': word,
        'krosemarket-wordmark-white.png': word_w,
        'krosemarket-logo.png': lockup_stacked(mark, word),
        'krosemarket-logo-white.png': lockup_stacked(mark_w, word_w),
        'krosemarket-logo-h.png': lockup_h(mark, word),
        'krosemarket-logo-h-white.png': lockup_h(mark_w, word_w),
        'krosemarket-icon.png': mark,
    }
    for name, im in assets.items():
        im.save(OUT + name)
        print(f'{name:34s} {im.size[0]}x{im.size[1]}')


def _trim_rgba(block):
    al = block[..., 3]
    ys = np.where(al.max(axis=1) > 8)[0]
    xs = np.where(al.max(axis=0) > 8)[0]
    return block[ys.min():ys.max() + 1, xs.min():xs.max() + 1]


if __name__ == '__main__':
    main()
