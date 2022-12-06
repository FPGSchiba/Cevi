from time import sleep

from tqdm import tqdm

PASSWORD = '1chB1nDeSam1chlaus!?'

print('=' * 5 + ' PASSWORT KONVERTIEREN ' + '=' * 5)

something = input('Password Eingeben: ')
c1, c2, c3, c4, c5, c6 = input('Bitte Codes Eingeben: ').split()

print(f'== Konvertiere - {c1}-{c3}-{c2}-{c4}-{c5}-{c6} - Konvertiere ==')

array = tqdm(range(1200))

for i in array:
    array.set_description('Passwort wird Konvertiert')
    sleep(0.01)

print(f'Konvertiertes Passwort: {PASSWORD}')
