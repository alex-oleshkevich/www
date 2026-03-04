# Beginner Legacy Site

This repository preserves a personal web project from 2004.

I built it while I was still in school with my friend Ring. We were learning web development, experimenting with PHP, and publishing a funny little site where we wanted to share programming knowledge with other people. The project is messy, sincere, and very much a product of that time, which is why I wanted to keep it alive instead of rewriting it into something modern.

| Topic | Details |
| --- | --- |
| Original release | 2004 |
| Authors | Me and Ring |
| Stack | Legacy PHP, file-based content and logs |
| Current runtime | PHP 8 in Docker |
| Local URL | `http://localhost:8085` |

## What The Site Contains

The site includes:

- Delphi FAQ
- Pascal FAQ
- Tutorials
- Download pages
- A forum / guestbook
- Small admin pages
- Counters, logs, and content stored in text files

Most of the original structure, content, and behavior are still in place.

## Current Status

The original code targeted the PHP 3 / PHP 4 era. This repository now runs on PHP 8 through a compatibility-focused port that keeps the old code style intact as much as possible.

The port includes:

- full `<?php` tags instead of short tags
- a compatibility shim for legacy globals such as `$HTTP_*_VARS`
- compatibility wrappers for removed functions such as `ereg*`, `split`, and `each`
- the original `windows-1251` charset
- the original file-based storage model

The result is still intentionally old-looking code. That is part of the value of the project.

## Run Locally

### Run With `just`

Use the helper commands in [`justfile`](./justfile):

```bash
just run
```

This command builds the Docker image and starts the site at:

`http://localhost:8085`

Other commands:

```bash
just build
just run-bg
just stop
```

### Run With Docker

You can also run the project directly with Docker:

```bash
docker build -t beginner-legacy .
docker run --rm -p 8085:80 beginner-legacy
```

Then open:

`http://localhost:8085`

## Project Layout

| Path | Purpose |
| --- | --- |
| `index.php`, `head.php`, `menu.php`, `foot.php` | Main site shell |
| `delphifaq.php`, `pascalfaq.php` | FAQ pages |
| `tutorial/` | Tutorial content |
| `forum/` | Forum and guestbook system |
| `article/` | Generated article pages |
| `logs/`, `pages/`, `counter/` | File-based storage |
| `compat.php` | PHP 8 compatibility shim |
| `Dockerfile` | Container runtime |
| `justfile` | Local helper commands |
| `php8-port/` | Separate snapshot of the ported tree |

## Notes

- The project uses `windows-1251`, so encoding matters when serving and editing files.
- The content, design, and wording are historical. I preserved them on purpose.
- Some code paths reflect how two teenagers learned web development in 2004. That context is part of the project, not an accident.

## Why Keep It

Early projects matter.

This site is not a polished product. It is a record of learning, curiosity, awkward experiments, funny ideas, and the point in time when building for the web still felt new.
