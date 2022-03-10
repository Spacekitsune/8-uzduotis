Instructions Sukurti modelį Owner: ID - BigInt name - string(255)
surname - string (255) email - string(255) phone - string(255) Sukurti
modelį Task: title - string description - string start\_date - date
end\_date - date logo - string owner\_id - unsignedBigInteger (3) Task
modelį papildyti laukeliu owner\_id ir sukurti ryšį. Prie kiekvieno Task
index.blade.php lentelėje turi atvaizduoti Owner vardą ir pavardę. Pagal
Owner turi būti galima rikiuoti Tasks. (4) Sukurti visas Owner CRUD
operacijas. (5 )Pridėti visų sukurtų laukelių validacijas: tasks.title -
privalomas, tik lotyniškos raidės, maksimalus simbolių kiekis 225,
minimalus 6 tasks.description - privalomas, maksimalus simbolių kiekis
1500 tasks.start\_date - privalomas, datos formatas tasks.end\_date -
privalomas, datos formatas, vėlesnė nei tasks.start\_date
tasks.owner\_id - skaičius daugiau už 0, privalomas tasks.logo -
pavieksliukas owners.name - privalomas, tik lotyniškos raidės,
maksimalus simbolių kiekis 15, minimalus 2 owners.surname - privalomas,
tik lotyniškos raidės, maksimalus simbolių kiekis 15, minimalus 2,
owners.email - privalomas, patikrinti ar tai tikrai elektroninis paštas.
owners.phone - privalomas, patikrinti ar numeris lietuviško formato,
maksimalus simbolių kiekis - tiek, kiek lietuviško formato numeris gali
turėti.

