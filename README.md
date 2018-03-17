# LP-register
Localhosted web application with overview of all your LPs. Christmas present for my parents, christmas 2016

## Requirments & Set Up
You need XAMPP installed.
Place all these files in the 'htdocs' folder.

## Functonality
- Add album(with name of album, artist, year, songs and optionally a comment)
- Search:
  - Song
  - Artist
  - Year
  - Album
- List all albums
- Delete an album

## Database structure
This web application uses XML to save all albums.
XML-format:
  <LPdb>
      <LP>
          <title>
          <creator>
          <date>
          <comment>
          <disc>
              <track>
