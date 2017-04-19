SELECT translation.translation_id, translation.name, translation.abbr, translation.copyright,
chapter.chapter_no, verse_passage.passage AS 'grid_paragraph'
FROM translation
LEFT JOIN verse_passage ON verse_passage.translation_id = translation.translation_id
LEFT JOIN chapter ON chapter.chapter_id = verse_passage.chapter_id
WHERE chapter.chapter_no != ''
AND translation.translation_id IN (2, 5)
ORDER BY translation.name, chapter.chapter_no;