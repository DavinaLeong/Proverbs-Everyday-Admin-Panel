-- Chapter Passage
SELECT chapter_passage.*, chapter.chapter_no, translation.name, translation.abbr
FROM chapter_passage
  LEFT JOIN chapter ON chapter.chapter_id = chapter_passage.chapter_id
  LEFT JOIN translation ON translation.translation_id = chapter_passage.translation_id
WHERE chapter.chapter_no = 1
  AND translation.abbr = 'kjv'
  AND chapter_passage.status = 'Published';

-- Verse Passage
SELECT verse_passage.*, chapter.chapter_no, translation.name, translation.abbr
FROM verse_passage
  LEFT JOIN chapter ON chapter.chapter_id = verse_passage.chapter_id
  LEFT JOIN translation ON translation.translation_id = verse_passage.translation_id
WHERE chapter.chapter_no = 1
  AND translation.abbr = 'KJV'
  AND verse_passage.status = 'Published';