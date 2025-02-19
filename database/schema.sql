CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reset_token VARCHAR(255) NULL,
    reset_token_expiry DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE result_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    token VARCHAR(100) NOT NULL,
    expiry DATETIME NOT NULL,
    UNIQUE (token)
);

CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    personality_type VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE RESPONCES (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userid INT NOT NULL,
    question_responce JSON NOT NULL,
    FOREIGN KEY (userid) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE Questions (
    qid INT AUTO_INCREMENT PRIMARY KEY,
    qtext TEXT NOT NULL
);

CREATE TABLE data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    personality_type VARCHAR(50) NOT NULL,
    result_group VARCHAR(50) NOT NULL,
    aspects TEXT NOT NULL,
    description_links TEXT NOT NULL,
    displayed_behaviours TEXT NULL,
    careers TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);




INSERT INTO Questions (qtext) 
VALUES 
('When the phone rings, you hurry to get to it first and don\'t hope someone else gets it.'),
('You are more observant than introspective.'),
('Is it worse to have your head in the clouds than to be in a rut?'),
('With people, you are usually more firm than gentle.'),
('You are more comfortable making critical judgments than value judgments.'),
('Clutter in the workplace is something you take time to straighten up rather than tolerate pretty well.'),
('It is your way to make up your mind quickly.'),
('Waiting in line, you often chat with others.'),
('You are more sensible than ideational.'),
('You are more interested in what is actual than what is possible.'),
('In making up your mind, you are more likely to go by data than desires.'),
('In sizing up others, you tend to be more objective and impersonal than friendly and personal.'),
('You prefer contracts to be signed, sealed, and delivered rather than settled on a handshake.'),
('You are more satisfied having a finished product than a work in progress.'),
('At a party, you interact with many, even strangers, rather than interact with a few friends.'),
('You tend to be more factual than speculative.'),
('You like writers who say what they mean rather than use metaphors and symbolism.'),
('Consistency of thought appeals more than harmonious relationships.'),
('When disappointing someone, you are more frank and forthright than warm and considerate.'),
('On the job, you want your activities scheduled.'),
('You more often prefer final, unalterable statements to tentative, preliminary statements.'),
('Interacting with strangers energizes you more than it taxes your reserves.'),
('Facts speak for themselves rather than illustrate principles.'),
('You find visionaries and theorists more annoying than fascinating.'),
('In a heated discussion, you stick to your guns and don\'t look for common ground.'),
('It is better to be just than merciful.'),
('At work, it is more natural for you to point out mistakes than try to please others.'),
('You are more comfortable after a decision than before.'),
('You tend to say right out what\'s on your mind more than keep your ears open.'),
('Common sense is usually more reliable than frequently questionable.'),
('Children should make themselves more useful rather than exercise their fantasy.'),
('When in charge of others, you tend to be more firm and unbending than forgiving and lenient.'),
('You are more often a cool-headed person rather than warm-hearted.'),
('You are more prone to nailing things down than exploring the possibilities.'),
('In most situations, are you more deliberate than spontaneous?'),
('You think of yourself as more outgoing than private.'),
('You are more frequently a practical sort of person and not fanciful.'),
('You speak more in particulars than generalities.'),
('Being called a logical person is more of a compliment than being called sentimental.'),
('Your thoughts rule you more than your feelings.'),
('When finishing a job, you\'d rather tie up loose ends than move on to something else.'),
('You rather work to deadlines than just whenever.'),
('You are more the talkative kind of person than one who doesn\'t miss much.'),
('You are inclined to take what is said more literally than figuratively.'),
('You more often see what is right in front of you than what can only be imagined.'),
('Is it worse to be a softy than hard-nosed?'),
('In trying circumstances, you are more too unsympathetic than sympathetic.'),
('You tend to choose more carefully than impulsively.'),
('You are inclined to be more hurried than leisurely.'),
('At work, you tend to be more sociable with colleagues than keeping to yourself.'),
('You are more likely to trust your experiences than your conceptions.'),
('You are more inclined to feel down to earth than somewhat removed.'),
('You think of yourself as more tough-minded than tender-hearted.'),
('You value in yourself more that you are reasonable rather than devoted.'),
('You usually want things more settled and decided than just penciled in.'),
('You are more serious and determined than you are easygoing.'),
('You consider yourself a better conversationalist than a good listener.'),
('You prize in yourself your strong hold on reality over your vivid imagination.'),
('You are drawn more to fundamentals than overtones.'),
('It is a greater fault to be too compassionate than too dispassionate.'),
('You are swayed more by convincing evidence than a touching appeal.'),
('You feel better about coming to closure than keeping your options open.'),
('Is it preferable mostly to make sure things are arranged rather than let things happen naturally?'),
('You are inclined to be more easy to approach than somewhat reserved.'),
('In stories, you prefer action and adventure to fantasy and heroism.'),
('Is it easier for you to put others to good use than identify with others?'),
('You wish strength of will for yourself more than strength of emotion.'),
('You are more thick-skinned than thin-skinned.'),
('You tend to notice disorderliness more than opportunities for change.'),
('You are more routine than whimsical.');
  


INSERT INTO data (personality_type, result_group, aspects, description_links, displayed_behaviours, careers)
VALUES
('ENFJ', 'Idealists', 'The Teacher', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=3&c=teacher', 'Outgoing, social, attention seeking, emotional, loving, organized, comfortable around others, involved, open, hyperactive, complimentary, punctual, considerate, altruistic, easily hurt, religious, neat, content, positive, affectionate, image-conscious, good at getting people to have fun, easily excited, perfectionist, assertive, ambitious, leader, hard-working, seductive, touchy, group-oriented, anti-tattoos.', 'Casting directory, film critic, wedding planner, work in the performing arts, teacher (art, preschool, elementary), actor, fashion designer, news anchor, fashion merchandiser, school psychologist, broadcaster, stylist, interior designer, event coordinator, restaurant owner, childcare worker, hair stylist, film director, counselor, dancer.'),
('ENFP', 'Idealists', 'The Champion', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=3&c=champion', 'Outgoing, social, disorganized, easily talked into doing silly things, spontaneous, wild and crazy, acts without thinking, good at getting people to have fun, pleasure seeking, irresponsible, physically affectionate, risk taker, thrill seeker, likely to have or want a tattoo, adventurous, unprepared, attention seeking, hyperactive, irrational, loves crowds, rule breaker, prone to losing things, seductive, easily distracted, open, revealing, comfortable in unfamiliar situations, attracted to strange things, non-punctual, likes to stand out, likes to try new things, fun seeker, unconventional, energetic, impulsive, empathetic, dangerous, loving, attachment prone, prone to fantasy.', 'Performer, actor, entertainer, songwriter, musician, filmmaker, comedian, radio broadcaster/DJ, some job related to theater/drama, poet, music journalist, work in fashion industry, singer, movie producer, playwright, bartender, comic book author, work in television, dancer, artist, record store owner, model, freelance artist, teacher (art, drama, music), writer, painter, massage therapist, costume designer, choreographer, make-up artist.'),
('ENTJ', 'Rationals', 'The Fieldmarshal', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=5&c=fieldmarshal', 'Decisive, fearless, planner, thrill seeker, engaged, social, self-centered, comfortable around others, image conscious, likes to be center of attention, adventurous, outgoing, manipulative, emotionally stable, leader, ambitious, hard-working, dominant, prepared, hates to be bored, confident, opinionated, analytical, prepares for worst-case scenarios, organized, orderly, clean, driven, resourceful, finishes most things they start, achieving, risk taker, desires fame/acclaim, image focused, narcissistic, arrogant, perfectionist, driven, academic, scientific, critical, avoids giving in to others.', 'Marketing specialist, government employee, lawyer, developer, political scientist, bounty hunter, international relations specialist, software designer, systems analyst, business manager, entertainment lawyer, foreign service officer, strategist, project manager, advertising executive, CIA agent, marketing manager, geneticist, private investigator, administrator, business analyst, politician, management consultant, producer, financial advisor, entrepreneur, genetics researcher, cardiologist, professor, investigator, or detective.'),
('ENTP', 'Rationals', 'The Inventor', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=5&c=inventor', 'Risk taker, easy-going, outgoing, social, open, rule breaker, thrill seeker, life of the party, comfortable in unfamiliar situations, appreciates strangeness, disorganized, adventurous, talented at presentation, aggressive, attention-seeking, experience junky, insensitive, adaptable, not easily offended, messy, carefree, dangerous, fearless, careless, emotionally stable, spontaneous, improviser, always joking, player, wild and crazy, dominant, acts without thinking, not into organized religion, pro-weed legalization.', 'Dictator, computer consultant, international spy, TV producer, philosopher, comedian, music performer, IT consultant, fighter pilot, politician, diplomat, entertainer, game designer, bar owner, freelance writer, creative director, strategist, news anchor, professional skateboarder, airline pilot, comic book artist, college professor, private detective, mechanical engineer, lecturer, ambassador, astronomer, research scientist, judge, web developer, scholar, FBI agent, CIA agent, electrical engineer, assassin.'),
('ESFJ', 'Guardians', 'The Provider', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=2&c=provider', 'Does not like being alone, thinks life has purpose/meaning, organized, values organized religion, outgoing, social, does not like strange people/things - likely intolerant of differences, open, easy to read, dislikes science fiction, values relationships and families over intellectual pursuits, group-oriented, follows the rules, affectionate, planner, regular, orderly, clean, finisher, religious, consults others before acting, content, positive, loves getting massages, complimentary, dutiful, loving, considerate, altruistic.', 'Wedding planner, social worker, pediatrician, public health employee, kindergarten teacher, business consultant, nurse, human resources manager, office manager, executive assistant, public relations specialist, medical employee, human resources, office worker, social services, child care worker.'),
('ESFP', 'Artisans', 'The Performer', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=4&c=performer', 'Outgoing, social, group-oriented, dislikes science fiction, does not like to be alone, feels at ease around others, conventional, talkative, modest, does not like to be alone, good at getting people to have fun, values relationships and family over intellectual pursuits, open, likes to dance, spontaneous, underachieving, at times unprepared, emotional, values organized religion, suggestible, at times easy to impress, not analytical, disorganized, prone to crying, likes to be center of attention, happy, trusts others, can be influenced more by others than self, can be touchy-feely, feels the emotions of others, likes teamwork.', 'Public relations manager, school teacher, radio DJ, customer service, EMT, hair stylist, event coordinator, pediatric nurse, child care worker, makeup artist, personal trainer, public relations, human resources, travel agent, massage therapist, physical therapist, interior decorator.'),
('ESTJ', 'Guardians', 'The Supervisor', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=2&c=supervisor', 'Organized, group-oriented, focused, conventional, leader, emotionally stable, attention-seeking, planner, realistic, fearless, responsible, finisher, decisive, norm-following, respects authority, punctual, hard-working, stiff, self-confident, thinks rules and regulations are important, follows the rules, clean, outgoing, social, content, does not like being alone, normal, regular, does not like weird or strange people/things - intolerant of differences, strict, disciplined, aggressive, assertive, content, happy, proper, formal, strict with self, meticulous, strong sense of purpose.', 'Executive, CEO, supervisor, business consultant, manager, strategist, financial planner, business person, office manager, public relations manager, international business specialist, business analyst, management consultant, operations manager, loan officer, lawyer, marketing, sports management, government employee, investment banker.'),
('ESTP', 'Artisans', 'The Promoter', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=4&c=promoter', 'Content, emotionally stable, outgoing, social, group-oriented, finisher, does not like to be alone, open, decisive, likes external praise, likes to be center of attention, frequently joking, adjusts easily, likes crowds, self-confident, neutral moods, good at getting people to have fun, disorganized, messy, talented at presentation, not easily annoyed, does not like to be alone, enjoys crude jokes, likes to lead, likes sports, more likely to come off as masculine, risk taker, tends to dominate conversations, fearless, can handle criticism, hard to discourage.', 'CEO, sports management, fighter pilot, marketing specialist, business manager, race car driver, supervisor, economist, airline pilot, bar owner, consultant, CIA agent, security specialist, technician, businessman, mechanical engineer, public relations specialist, coach, manager, marketing director, sales associate, mechanic, politician, publicist.'),
('INFJ', 'Idealists', 'The Counselor', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=3&c=counselor', 'Creative, smart, focus on fantasy more than reality, attracted to sad things, fears doing the wrong thing, observer, avoidant, fears drawing attention to self, anxious, cautious, somewhat easily frightened, easily offended, private, easily hurt, socially uncomfortable, emotionally moody, does not like to be looked at, fearful, perfectionist, can sabotage self, can be wounded at the core, values solitude, guarded, does not like crowds, organized, second-guesses self, more likely to support marijuana legalization, focuses on people’s hidden motives, prone to crying, not competitive, prone to feelings of loneliness, not spontaneous, prone to sadness, longs for a stabilizing relationship, fears rejection in relationships, frequently worried, can feel victimized, prone to intimidation, lower energy, strict with self.', 'Psychotherapist, artist, art curator, bookstore owner, freelance writer, poet, teacher (art, drama, English), library assistant, professor of English, painter, novelist, book editor, copywriter, philosopher, environmentalist, bookseller, museum curator, opera singer, magazine editor, archivist, music therapist, screenwriter, film director, creative director, librarian, social services worker, art historian, sign language interpreter, photo journalist, makeup artist, homemaker.'),
('INFP', 'Idealists', 'The Healer', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=3&c=healer', 'Creative, smart, idealist, loner, attracted to sad things, disorganized, avoidant, can be overwhelmed by unpleasant feelings, prone to quitting, prone to feelings of loneliness, ambivalent of the rules, solitary, daydreams about people to maintain a sense of closeness, focus on fantasies, acts without planning, low self-confidence, emotionally moody, can feel defective, prone to lateness, likes esoteric things, wounded at the core, feels shame, frequently losing things, prone to sadness, prone to dreaming about a rescuer, disorderly, observer, easily distracted, does not like crowds, can act without thinking, values privacy, can feel uncomfortable around others, familiar with the  hermit, more likely to support marijuana legalization, can sabotage self, likes the rain, sometimes can’t control fearful thoughts, prone to crying, prone to regret, attracted to counterculture, can be submissive, prone to feeling discouraged, frequently second-guesses self, not punctual, not always prepared, can feel victimized.', 'Poet, painter, freelance artist, musician, writer, art therapist, teacher (art, music, drama), songwriter, art historian, library assistant, composer, work in the performing arts, art curator, playwright, bookseller, cartoonist, video editor, photographer, philosopher, record store owner, digital artist, cinematographer, costume designer, film producer, philosophy professor, librarian, music therapist, environmentalist, movie director, activist, bookstore owner, filmmaker.'),
('INTJ', 'Rationals', 'The Mastermind', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=5&c=mastermind', 'Loner, more interested in intellectual pursuits than relationships or family, not very altruistic, not very complimentary, would rather be friendless than jobless, observer, values solitude, perfectionist, detached, private, not much fun, hidden, skeptical, does not tend to like most people, socially uncomfortable, not physically affectionate, unhappy, does not talk about feelings, hard to impress, analytical, likes esoteric things, tends to be pessimistic, not spontaneous, prone to discontentment, guarded, does not think they are weird but others do, responsible, can be insensitive or ambivalent to the misfortunes of others, orderly, clean, organized, familiar with the darkside.', 'Scientist, dictator, forensic anthropologist, systems analyst, philosopher, nuclear engineer, political analyst, researcher, statistician, scholar, research scientist, computer scientist, software designer, curator, computer programmer, aerospace engineer, electrical engineer, paleontologist, English professor, philosophy professor, chemical engineer, epidemiologist, forensic scientist, museum curator, research assistant, mechanic, astronomer, fighter pilot, librarian, systems administrator, neurosurgeon, book editor, biotechnology specialist, archeologist, lab technician, bookstore owner.'),
('INTP', 'Rationals', 'The Architect', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=5&c=architect', 'Loner, more interested in intellectual pursuits than relationships or family, wrestles with the meaninglessness of existence, likes esoteric things, disorganized, messy, likes science fiction, can be lonely, observer, private, can/t describe feelings easily, detached, likes solitude, not revealing, unemotional, rule breaker, avoidant, familiar with the darkside, skeptical, acts without consulting others, does not think they are weird but others do, socially uncomfortable, abrupt, fantasy-prone, does not like happy people, appreciates strangeness, frequently loses things, acts without planning, guarded, not punctual, more likely to support marijuana legalization, not prone to compromise, hard to persuade, relies on mind more than on others.', 'Calm philosopher, game designer, scientist, software engineer, freelance artist, research scientist, assassin, freelance writer, physicist, software developer, mathematician, geologist, computer scientist, philosophy professor, webmaster, slacker, medical researcher, painter, mortician, systems analyst, comic book artist, computer technician, website designer, scholar, archeologist, computer repair technician, forensic anthropologist, astronaut, researcher, historian, systems engineer, genetics researcher, astronomer, environmental scientist, Egyptologist.'),
('ISFJ', 'Guardians', 'The Protector', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=2&c=protector', 'Follows the rules, polite, fears drawing attention to self, dislikes competition, somewhat easily frightened, easily offended, timid, dutiful, private, lower energy, finisher, organized, socially uncomfortable, modest, not confrontational, easily hurt, observer, prone to crying, not spontaneous, does not appreciate strangeness (intolerant to differences), apprehensive, clean, planner, prone to confusion, afraid of many things, responsible, guarded, avoidant, anxious, cautious, suspicious, more interested in relationships and family than intellectual pursuits.', 'Homemaker, stay-at-home parent, office worker, healthcare worker, personal assistant, school teacher, administrative assistant, childcare worker, clerical employee, receptionist, library assistant, dietitian, health educator, librarian.'),
('ISFP', 'Artisans', 'The Composer', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=4&c=Composer', 'Disorganized, timid, prone to discouragement, socially uncomfortable, does not like leadership, suggestible, not self-confident, not aggressive, lower energy, fearful, anxious, easily distracted, prone to discontentment, guarded, not confrontational, prone to longing for a stabilizing relationship, can be overwhelmed by unpleasant feelings, easily disturbed, fears drawing attention to self, prone to confusion, private, second-guesses self, prone to quitting, underachiever, fears rejection in relationships, emotionally moody.', 'Sports management, pediatrician, school teacher, carpenter, veterinary technician, singer, health educator, stay-at-home parent, hospitality worker, pastor, athlete, physician assistant, photographer, healthcare worker, shop assistant, stylist, website designer.'),
('ISTJ', 'Guardians', 'The Inspector', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=2&c=inspector', 'Responsible, planner, private, loner tendencies, perfectionist, organized, detail-oriented, would rather be friendless than jobless, realistic, observer, clean, focused, does not talk about feelings, finishes tasks, punctual, does not appreciate strangeness, not adventurous, not spontaneous, follows the rules, dutiful, avoids mistakes, conventional, likes solitude, insensitive to the hardships of others, prepared, anti-tattoos, believes rules are important, cautious, security-seeking, prepares for worst-case scenarios, logical, analytical, does not accept apologies easily, hard-working.', 'Data analyst, scientist, researcher, engineer, financial planner, statistician, office worker, government employee, lab technician, nuclear engineer, office manager, biomedical engineer, account manager, technician, investment banker, analyst, academic, systems analyst, pharmacy technician, network administrator, genetics researcher, research assistant, strategist.'),
('ISTP', 'Artisans', 'The Crafter', 'http://www.keirsey.com/handler.aspx?s=keirsey&f=fourtemps&tab=4&c=crafter', 'Hidden, private, has trouble describing feelings, not very affectionate, loner tendencies, lower energy, can be insensitive to the misfortunes of others, disorganized, messy, fears drawing attention to self, anti-tattoos, anti-counterculture, not comfortable in unfamiliar situations, avoidant, rather unemotional, does not like attention, more interested in intellectual pursuits than relationships or family, hermetic, not complimentary, dislikes leadership, more submissive than domineering.', 'Aerospace engineer, technician, computer scientist, software engineer, software developer, scientist, bar owner, automotive technician, electrician, engineer, mathematician, industrial engineer, nuclear engineer, biotechnologist, mechanic, systems analyst, computer animator, data analyst, video game designer.');



