/* This file creates the database table entries. */

/* Insert users.
   Remark: do no store passwords in plain text (like we do here).*/
DELETE FROM users;
INSERT INTO users
VALUES (NULL, 'Artur', 'Adam', 'artur.adam@bukubuku.com', 'Pw1234!', TRUE),
       (NULL, 'Max', 'Maier', 'max.maier@gmail.com', 'Pw1234!', FALSE), 
       (NULL, 'Sonja', 'Schmitt', 'sonja.schmitt@outlook.com', 'Pw1234!', FALSE);

/* Insert books. */
DELETE FROM books;
INSERT INTO books
VALUES (NULL, 'Das Kalendermädchen', 'Sebastian Fitzek', '978-3426281741' , '2024-10-23', 400, 'hardcover' ,'available'),   
       (NULL, 'Das Kalendermädchen', 'Sebastian Fitzek', '978-3426444375' , '2024-10-23', 400, 'kindle' ,'available'),
       (NULL, 'Das Kalendermädchen', 'Sebastian Fitzek', '978-3426444375' , '2024-10-23', 400, 'kindle' ,'available'),
       (NULL, 'Man kann auch in die Höhe fallen', 'Joachim Meyerhoff', '978-3462313024' , '2024-11-7', 368, 'kindle' ,'available'),
       (NULL, 'Der Buchspazierer', 'Carsten Henn', '978-3492997157' , '2024-8-29', 240, 'kindle' ,'available'),
       (NULL, 'Der Buchspazierer', 'Carsten Henn', '978-3869525334' , '2024-8-29', 240, 'audio_book' ,'checked_out'),
       (NULL, 'Der Buchspazierer', 'Carsten Henn', '978-3869525334' , '2024-8-29', 240, 'audio_book' ,'available'),
       (NULL, 'Dunkles Wasser', 'Charlotte Link', '978-3641242442' , '2024-8-21', 576, 'kindle' ,'available'),
       (NULL, 'Dunkles Wasser', 'Charlotte Link', '978-3641242442' , '2024-8-21', 576, 'kindle' ,'available'),
       (NULL, 'Dunkles Wasser', 'Charlotte Link', '978-3641242442' , '2024-8-21', 576, 'kindle' ,'available'),
       (NULL, 'Zwischen Ende und Anfang', 'Jojo Moyes', '978-3805201155' , '2024-12-10', 528, 'hardcover' ,'available'),
       (NULL, 'Zwischen Ende und Anfang', 'Jojo Moyes', '978-3805201155' , '2024-12-10', 528, 'hardcover' ,'available'),
       (NULL, 'Zwischen Ende und Anfang', 'Jojo Moyes', '978-3644019867' , '2024-12-10', 528, 'kindle' ,'available'),
       (NULL, 'Zwischen Ende und Anfang', 'Jojo Moyes', '978-3644019867' , '2024-12-10', 528, 'kindle' ,'available'),
       (NULL, 'Das Mädchen aus Yorkshire', 'Lucinda Riley', '978-3442317837' , '2024-11-7', 620, 'hardcover' ,'available'),
       (NULL, 'Das Mädchen aus Yorkshire', 'Lucinda Riley', '978-3442317837' , '2024-11-7', 620, 'hardcover' ,'available'),
       (NULL, 'Hey guten Morgen, wie geht es dir?', 'Martina Hefter', '978-3608988260' , '2024-7-13', 224, 'hardcover' ,'checked_out'),
       (NULL, 'Hey guten Morgen, wie geht es dir?', 'Martina Hefter', '978-3608988260' , '2024-7-13', 224, 'hardcover' ,'available'),
       (NULL, 'Hey guten Morgen, wie geht es dir?', 'Martina Hefter', '978-3608123531' , '2024-7-13', 224, 'kindle' ,'available'),
       (NULL, 'Hey guten Morgen, wie geht es dir?', 'Martina Hefter', '978-3608123531' , '2024-7-13', 224, 'kindle' ,'available'),
       (NULL, 'Hey guten Morgen, wie geht es dir?', 'Martina Hefter', '978-3608123531' , '2024-7-13', 224, 'kindle' ,'available'),
       (NULL, 'Windstärke 17', 'Caroline Wahl', '978-3755810032' , '2024-5-15', 256, 'kindle' ,'available'),
       (NULL, 'Windstärke 17', 'Caroline Wahl', '978-3755810032' , '2024-5-15', 256, 'kindle' ,'available'),
       (NULL, 'Windstärke 17', 'Caroline Wahl', '978-3755810032' , '2024-5-15', 256, 'kindle' ,'available'),
       (NULL, 'Umlaufbahnen', 'Samantha Harvey', '978-3423444958' , '2024-11-14', 208, 'kindle' ,'available'),
       (NULL, 'Zauberberg 2', 'Heinz Strunk', '978-3644021051' , '2024-11-28', 288, 'kindle' ,'available'),
       (NULL, 'Zauberberg 2', 'Heinz Strunk', '978-3644021051' , '2024-11-28', 288, 'kindle' ,'available'),
       (NULL, 'Zauberberg 2', 'Heinz Strunk', '978-3864848650' , '2024-11-28', 288, 'audio_book' ,'available'),
       (NULL, 'Zauberberg 2', 'Heinz Strunk', '978-3864848650' , '2024-11-28', 288, 'audio_book' ,'available'),
       (NULL, 'Zauberberg 2', 'Heinz Strunk', '978-3864848650' , '2024-11-28', 288, 'audio_book' ,'available'),
       (NULL, 'Vergissmeinnicht - Was die Welt zusammenhält', 'Kerstin Gier', '978-3104919683' , '2024-11-27', 528, 'kindle' ,'available'),
       (NULL, 'Vergissmeinnicht - Was die Welt zusammenhält', 'Kerstin Gier', '978-3839821299' , '2024-11-27', 528, 'audio_book' ,'available'),
       (NULL, 'Lückenbüßer (Kluftinger-Krimis 13)', 'Volker Klüpfel', '978-3550201479' , '2024-9-26', 432, 'hardcover' ,'checked_out'),
       (NULL, 'Lückenbüßer (Kluftinger-Krimis 13)', 'Volker Klüpfel', '978-3550201479' , '2024-9-26', 432, 'hardcover' ,'available'),
       (NULL, 'Lückenbüßer (Kluftinger-Krimis 13)', 'Volker Klüpfel', '978-3843732437' , '2024-9-26', 432, 'kindle' ,'available'),
       (NULL, 'Pi mal Daumen', 'Alina Bronsky', '978-3462311334' , '2024-8-15', 272, 'kindle' ,'available'),
       (NULL, 'Pi mal Daumen', 'Alina Bronsky', '978-3742433343' , '2024-8-15', 272, 'audio_book' ,'available'),
       (NULL, 'Pi mal Daumen', 'Alina Bronsky', '978-3742433343' , '2024-8-15', 272, 'audio_book' ,'available'),
       (NULL, 'Zwei Leben', 'Ewald Arenz', '978-3832182052' , '2024-9-13', 362, 'hardcover' ,'available'),
       (NULL, 'Zwei Leben', 'Ewald Arenz', '978-3832182052' , '2024-9-13', 362, 'hardcover' ,'available'),
       (NULL, 'Helden', 'Frank Schätzing', '978-3462000979' , '2024-10-16', 1040, 'hardcover' ,'available'),
       (NULL, 'Helden', 'Frank Schätzing', '978-3462000979' , '2024-10-16', 1040, 'hardcover' ,'available'),
       (NULL, 'Helden', 'Frank Schätzing', '978-3462000979' , '2024-10-16', 1040, 'hardcover' ,'available'),    
       (NULL, 'Helden', 'Frank Schätzing', '978-3462302622' , '2024-10-16', 1040, 'kindle' ,'available'),
       (NULL, 'Helden', 'Frank Schätzing', '978-3462302622' , '2024-10-16', 1040, 'kindle' ,'available'),
       (NULL, 'Wenn ich nicht Urlaub mache, macht es jemand anderes', 'Giulia Becker', '978-3644008052' , '2024-11-12', 224, 'kindle' ,'checked_out'),
       (NULL, 'Wenn ich nicht Urlaub mache, macht es jemand anderes', 'Giulia Becker', '978-3644008052' , '2024-11-12', 224, 'kindle' ,'available'),
       (NULL, 'Wenn ich nicht Urlaub mache, macht es jemand anderes', 'Giulia Becker', '978-3644008052' , '2024-11-12', 224, 'kindle' ,'available'),
       (NULL, 'Monas Augen - Eine Reise zu den schönsten Kunstwerken unserer Zeit', 'Thomas Schlesser', '978-3492608862' , '2024-9-26', 496, 'kindle' ,'available'),
       (NULL, 'Der verliebte Schwarzbrenner und wie er die Welt sah', 'Jonas Jonasson', '978-3570104859' , '2024-11-6', 432, 'hardcover' ,'available'),
       (NULL, 'Der verliebte Schwarzbrenner und wie er die Welt sah', 'Jonas Jonasson', '978-3570104859' , '2024-11-6', 432, 'hardcover' ,'available'),
       (NULL, 'Der verliebte Schwarzbrenner und wie er die Welt sah', 'Jonas Jonasson', '978-3570104859' , '2024-11-6', 432, 'hardcover' ,'available'),
       (NULL, 'Der verliebte Schwarzbrenner und wie er die Welt sah', 'Jonas Jonasson', '978-3641295448' , '2024-11-6', 432, 'kindle' ,'checked_out'),
       (NULL, 'Der verliebte Schwarzbrenner und wie er die Welt sah', 'Jonas Jonasson', '978-3641295448' , '2024-11-6', 432, 'kindle' ,'available'),    
       (NULL, 'Der verliebte Schwarzbrenner und wie er die Welt sah', 'Jonas Jonasson', '978-3844552010' , '2024-11-6', 432, 'audio_book' ,'available'),
       (NULL, 'Der verliebte Schwarzbrenner und wie er die Welt sah', 'Jonas Jonasson', '978-3844552010' , '2024-11-6', 432, 'audio_book' ,'available'),
       (NULL, 'Rath (Die Gereon-Rath-Romane 10)', 'Volker Kutscher', '978-3492609104' , '2024-10-24', 624, 'kindle' ,'available'),
       (NULL, 'Rath (Die Gereon-Rath-Romane 10)', 'Volker Kutscher', '978-3492609104' , '2024-10-24', 624, 'kindle' ,'available'),
       (NULL, 'Ein anderes Leben', 'Caroline Peters', '978-3644015081' , '2024-10-15', 240, 'kindle' ,'available'),
       (NULL, 'Ein anderes Leben', 'Caroline Peters', '978-3839821275' , '2024-10-15', 240, 'audio_book' ,'available');

/* Insert checkouts. */
DELETE FROM checkouts;
INSERT INTO checkouts
VALUES (NULL, 2, 1, '2026-01-01 09:15:00', '2026-01-27 15:10:00'),
       (NULL, 2, 17, '2026-01-10 13:00:00', NULL),
       (NULL, 2, 33, '2026-01-10 13:00:00', NULL),
       (NULL, 3, 6, '2026-02-01 17:23:00', NULL), 
       (NULL, 3, 46, '2026-02-27 12:05:00', NULL), 
       (NULL, 3, 53, '2026-02-10 22:48:00', NULL);	