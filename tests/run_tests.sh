#!/bin/sh
# Comprueba la sintaxis de los archivos PHP modificados
FILES="$(git diff --name-only HEAD~1 | grep '\.php$')"
for f in $FILES; do
  if [ -f "$f" ]; then
    php -l "$f" || exit 1
  fi
done
