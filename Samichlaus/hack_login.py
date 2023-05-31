from time import sleep
from tqdm import tqdm

USERNAME = 'samichlaus'
PASSWORD = '1chB1nDeSam1chlaus!?'
LOGGED_IN = False

print('=' * 5 + ' SAMICHLAUS ANMELDUNG ' + '=' * 5)

while not LOGGED_IN:
    username = input('Benutzernamen eingeben: ')

    if username == USERNAME:
        password = input('Passwort eingeben: ')
        if password == PASSWORD:
            LOGGED_IN = True
        else:
            print(f"Passwort stimmt nicht für den Benutzer: {username}")
    else:
        print("Dieser Benutzer existiert nicht.")

array = tqdm(range(600))

for i in array:
    array.set_description('Lade Daten herunter')
    sleep(0.01)

with open('Samichlaus_daten.txt', 'r+', encoding='UTF-8') as file:
    data = file.read()
    print(data)

im.show()
