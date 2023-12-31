#!/bin/bash
# Este es un script para subir el repositorio eliminado la historia
# debido a que solo subo PDFs y cada cambio y mantenerlos hace que el repositorio aumente
# considerablemente
echo Borrando repositorio local...
rm -rf .git

# Iniciamos un nuevo repositorio
git init
# Añadimos los ficheros y hacemos comit en main
git add -A
date=`date +%Y-%m-%d_%H:%M:%S`
git commit -m "deploy ${date}"
git branch -M master

# Nos conectamos a remoto y subimos
echo Subiendo contenidos a GitHub...
git remote add origin https://github.com/joseluisgs/DesarrolloWebEntornosServidor-04-2023-2024.git
git push -u -f origin master

rm -rf .git

echo Fin :D