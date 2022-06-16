<?php

/*
  For example, these patterns are true:
  /api/characters?id=1
  /api/characters?limit=20
  /api/characters
  And these aren't true:
  /api/characters?id
  /api/characters?id=0
  /api/character
  /api/characters?blahblah
*/

return [

  "/^\/$/",
  "/^\/api\/characters(\?(id=|limit=)([1-9][0-9]*))?$/",
  "/^\/api\/countries(\?(id=|limit=)([1-9][0-9]*))?$/",
  "/^\/api\/cities(\?(id=|limit=)([1-9][0-9]*))?$/",
  "/^\/api\/professions(\?(id=|limit=)([1-9][0-9]*))?$/",
  
];