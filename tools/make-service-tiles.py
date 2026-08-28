"""
Build the two service-card tiles the template never shipped.

services.php has seven cards but the template only provided six serv-s*.png
thumbnails, all of them freight scenes. Real Estate and Property Management were
left borrowing freight tiles (and, on index.php, duplicating Air Freight's and
Ocean Freight's outright).

These two are cut from our own photography and pushed through the *exact* alpha
mask of serv-s1.png, so the corner radii and the notch match the six the template
supplied pixel for pixel. Re-run this if the source photos change; don't hand-edit
the outputs.

    python tools/make-service-tiles.py
"""
from PIL import Image, ImageEnhance
import os

ROOT = os.path.join(os.path.dirname(os.path.abspath(__file__)), '..')
MASK = Image.open(os.path.join(ROOT, 'images', 'serv-s1.png')).convert('RGBA').getchannel('A')
W, H = MASK.size   # 328 x 100

# (output, source photo, horizontal framing, vertical framing) — framing values are
# 0..1 across the crop that is thrown away; 0 keeps the left/top of the photo.
TILES = [
    ('serv-s7.png', 'images/gallery/construction-1.jpg', 0.50, 0.35),  # Real Estate
    # Framed hard right and zoomed past the van so the residential block, not the
    # delivery vehicle, is what the Property Management card reads as.
    ('serv-s8.png', 'images/gallery/shipping-20.jpg',    1.00, 0.28, 2.1),
    # Warehousing had been showing a container port. This is our own warehouse.
    ('serv-s9.png', 'images/gallery/shipping-18.jpg',    0.50, 0.45),
]

for spec in TILES:
    out_name, src_rel, xfocus, yfocus = spec[:4]
    zoom = spec[4] if len(spec) > 4 else 1.0
    src = Image.open(os.path.join(ROOT, src_rel)).convert('RGB')

    # Cover-crop to the tile's very wide aspect, keeping the interesting band.
    scale = max(W / src.width, H / src.height) * zoom
    src = src.resize((round(src.width * scale), round(src.height * scale)), Image.LANCZOS)
    top = round((src.height - H) * yfocus)
    left = round((src.width - W) * xfocus)
    src = src.crop((left, top, left + W, top + H))

    # The six template tiles are warm and saturated; match them so the row reads
    # as one set rather than two photos dropped in among six graphics.
    src = ImageEnhance.Color(src).enhance(1.15)
    src = ImageEnhance.Contrast(src).enhance(1.05)

    tile = src.convert('RGBA')
    tile.putalpha(MASK)
    tile.save(os.path.join(ROOT, 'images', out_name))
    print('wrote images/%s from %s' % (out_name, src_rel))
