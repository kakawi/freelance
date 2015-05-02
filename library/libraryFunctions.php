<?php
/**
 * libraryFunctions.php
 * Библиотека общих функций 
 */

/**
 * Функция загрузки страницы
 *
 * @param object $smarty Объект шаблонизатора
 * @param string $controllerName Имя контроллера
 * @param string $actionName Имя экшена
 */
function loadPage($smarty, $controllerName, $actionName = 'index') {
    $ok = 1;
	$ok2 = 1;
	
	// Список контроллеров сайта
	$controllers_list = array('Index', 'Admin', 'News', 'Games', 'Shop', 'Contact', 'Error', 'Articles', 'Category');
	
	foreach($controllers_list as $item) {
	    if(ucfirst($item) == $controllerName) {
		    $ok2 = 0;
			break;
		};
	}
	
	// Подключаем контроллер
	$ok2 == 1 ? $c = 'Index' : $c = $controllerName;
    include_once PATH_PREFIX . $c . PATH_POSTFIX;

	// Данные пользователя
    if($controllerName == 'Admin' && (int)$_SESSION['user']['id'] >= 1) $smarty->assign('user', userInfo($_SESSION['user']['id']));
	
	// Настройки сайта
	$settings = s("settings", "`type`='site' OR `type`='contacts'", "", "title");
	foreach($settings as $key => $val)
	{
	    $smarty->assign('ss_'.$val['option_alias'], $val['value']);
	}
	
	// Базовые экшны админ-панели
	$adm_actions = array('settings', 'profile', 'ajax', 'index', 'login', 'editwindow', 'descriptionwindow', 'upload');
	foreach($adm_actions as $item) {
		if($actionName == $item) {
		    $ok = 0;
			break;
		};
	}
	
    // Формируем название вызываемой функции
    ($controllerName == 'Admin' && $ok == 1) ? $function = 'adminpageAction' : $function = $actionName . 'Action';
	if($controllerName != 'Admin') {
	    $function = $actionName . 'Action';
		require_once '../models/MainModel.php';
	};
	if($ok2 == 1) $function = 'custompageAction';
    $function($smarty);
}

/**
 * Загрузка шаблона
 *
 * @param object $smarty Объект шаблонизатора
 * @param string $templateName Имя шаблона
 */
function loadTemplate($smarty, $templateName) {
    $smarty->display($templateName . TEMPLATE_POSTFIX);
}

/**
 * Функция отладки. Останавливает программу выводя значение переменной $value
 *
 * @param variant $value Переменная для вывода на страницу
 * @param integer $die Флаг, если == 1, то останавливает работу сайта
 */
function d($value = null, $die = 1) {
    echo 'Debug: <br /><pre>';
    print_r($value);
    echo '</pre>';
    
    if($die) die;
}

/**
 * Функция отладки №2. Останавливает программу выводя sql-запрос с подсветкой синтаксиса (dq = debug query)
 *
 * @param string $q sql-запрос
 * @param integer $die Флаг, если == 1, то останавливает работу сайта
 */
function dq($q, $die=1) {
    // Зарезервированные слова sql
	$reserved_sql_words = array('ABSOLUTE','ACTION','ABORT','ACTIVE','ADD','AFTER','ALL',
	                            'ALLOCATE','ALTER','ANALYZE','AND','ANY','ARE','AS','AS С',
								'ASCENDING','ASSERTION','AT','AUTHORIZATION','AUTO','AUTO-INCREMENT',
								'AUTOINC','AVG','BACKUP','BEFORE','BEGIN','BETWEEN','BIGINT','BINARY',
								'BIT','BLOB','BOOLEAN','BOTH','BREAK','BROWSE','BULK','BY','BYTES',
								'CACHE','CALL','CASCADE','CASCADED','CASE','CAST','CATALOG','CHANGE',
								'CHAR','CHARACTER','CHARACTERJ^ENGTH','CHECK','CHECKPOINT','CLOSE','CLUSTER',
								'CLUSTERED','COALESCE','COLLATE','COLUMN','COLUMNS','COMMENT','COMMIT',
								'COMMITTED','COMPUTE','COMPUTED','CONDITIONAL','CONFIRM','CONNECT','CONNECTION',
								'CONSTRAINT','CONSTRAINTS','CONTAINING','CONTAINS','CONTAINSTABLE','CONTINUE',
								'CONTROLROW','CONVERT','COPY','COUNT','CREATE','CROSS','CSTRING','CUBE',
								'CURRENT','CURRENT_DATE','CURRENTJTIME','CURRENT_TIMESTAMP','CURRENT_USER',
								'CURSOR','DATABASE','DATABASES','DATE','DATETIME','DAY','DBCC',
								'DEALLOCATE DECIMAL','','DEBUG DECLARE','DEC DEFAULT','DELETE','DENY','DESC',
								'DESCENDING DISK','DIV','DESCRIBE DISTINCT DO','DISCONNECT DISTRIBUTED DOMAIN',
								'DOUBLE','DROP','DUMMY','DUMP','ELSE','ELSEIF','ENCLOSED','END','ERRLVL',
								'ERROREXIT','ESCAPE','ESCAPED','EXCEPT','EXCEPTION','EXEC','EXECUTE','EXISTS',
								'EXIT','EXPLAIN','EXTEND','EXTERNAL','EXTRACT','FALSE','FETCH','FIELD','FIELDS',
								'FILE','FILLFACTOR','FILTER','FLOAT','FLOPPY','FOR','FORCE','FOREIGN','FOUND',
								'FREETEXT','FREETEXTTABLE','FROM','FULL','FUNCTION','GENERATOR','GET','GLOBAL',
								'GO','GOTO','GRANT','GROUP','HAVING','HOLDLOCK','HOUR','IDENTITY','IF','IN',
								'INACTIVE','INDEX','INDICATOR','INFILE','INNER','INOUT','INPUT','INSENSITIVE',
								'INSERT','INT','INTEGER','INTERSECT','INTERVAL','INTO','IS','ISOLATION','JOIN',
								'KEY','KILL','LANGUAGE','LAST','LEADING','LEFT','LENGTH','LEVEL','LIKE','LIMIT',
								'LINENO','LINES','LISTEN','LOAD','LOCAL','LOCK','LOGFILE','LONG','LOWER','MANUAL',
								'MATCH','MAX','MERGE','MESSAGE','MIN','MINUTE','MIRROREXIT','MODULE','MONEY','MONTH',
								'MOVE','NAMES','NATIONAL','NATURAL','NCHAR','NEXT','NEW','NO','NOCHECK','NONCLUSTERED',
								'NONE','NOT','NULL','NULLIF','NUMERIC','OF','OFF','OFFSET','OFFSETS','ON','ONCE','ONLY',
								'OPEN','OPTION','OR','ORDER','OUTER','OUTPUT','OVER','OVERFLOW','OVERLAPS','PAD','PAGE',
								'PAGES','PARAMETER','PARTIAL','PASSWORD','PERCENT','PERM','PERMANENT','PIPE','PLAN',
								'POSITION','PRECISION','PREPARE','PRIMARY','PRINT','PRIOR','PRIVILEGES','PROC',
								'PROCEDURE','PROCESSEXIT','PROTECTED','PUBLIC','PURGE','RAISERROR','READ','READTEXT',
								'REAL','REFERENCES','REGEXP','RELATIVE','RENAME','REPEAT','REPLACE','REPLICATION',
								'REQUIRE','RESERV','RESERVING','RESET','RESTORE','RESTRICT','RETAIN','RETURN','RETURNS',
								'REVOKE','RIGHT','ROLLBACK','ROLLUP','ROWCOUNT','RULE','SAVE','SAVEPOINT','SCHEMA',
								'SECOND','SECTION','SEGMENT','SELECT','SENSITIVE','SEPARATOR','SEQUENCE','SESSION_USER',
								'SET','SETUSER','SHADOW','SHARED','SHOW','SHUTDOWN','SINGULAR','SIZE','SMALLINT',
								'SNAPSHOT','SOME','SORT','SPACE','SQL','SQLCODE','SQLERROR','STABILITY','STARTING',
								'STARTS','STATISTICS','SUBSTRING','SUM','SUSPEND','TABLE','TABLES','TAPE','TEMP',
								'TEMPORARY','THEN','TO','TRAN','TRIGGER','TRUNCATE','UNIQUE','UPDATETEXT','USE','VALUE',
								'VARIABLE','VIEW','WAITFOR','WHILE','WRITE','YEAR','TEXT','TIME','TOP','TRANSACTION',
								'TRIM','UNCOMMITTED','UNTIL','UPPER','USER','VALUES','VARYING','VOLUME','WHEN','WITH',
								'WRITETEXT','ZONE','TEXTSIZE','TIMESTAMP','TRAILING','TRANSLATE','TRUE','UNION','UPDATE',
								'USAGE','USING','VARCHAR','VERBOSE','WAIT','WHERE','WORK','XOR');
	// Замена с подсветкой служебных слов
	$reserved_sql_words_replacement = array('<font color="#990099">ABSOLUTE</font>','<font color="#990099">ACTION</font>','<font color="#990099">ABORT</font>','<font color="#990099">ACTIVE</font>','<font color="#990099">ADD</font>','<font color="#990099">AFTER</font>','<font color="#990099">ALL</font>',
	                                        '<font color="#990099">ALLOCATE</font>','<font color="#990099">ALTER</font>','<font color="#990099">ANALYZE</font>','<font color="#990099">AND</font>','<font color="#990099">ANY</font>','<font color="#990099">ARE</font>','<font color="#990099">AS</font>','<font color="#990099">AS С</font>',
								            '<font color="#990099">ASCENDING</font>','<font color="#990099">ASSERTION</font>','<font color="#990099">AT</font>','<font color="#990099">AUTHORIZATION</font>','<font color="#990099">AUTO</font>','<font color="#990099">AUTO-INCREMENT</font>',
								            '<font color="#990099">AUTOINC</font>','<font color="#990099">AVG</font>','<font color="#990099">BACKUP</font>','<font color="#990099">BEFORE</font>','<font color="#990099">BEGIN</font>','<font color="#990099">BETWEEN</font>','<font color="#990099">BIGINT</font>','<font color="#990099">BINARY</font>',
								            '<font color="#990099">BIT</font>','<font color="#990099">BLOB</font>','<font color="#990099">BOOLEAN</font>','<font color="#990099">BOTH</font>','<font color="#990099">BREAK</font>','<font color="#990099">BROWSE</font>','<font color="#990099">BULK</font>','<font color="#990099">BY</font>','<font color="#990099">BYTES</font>',
								            '<font color="#990099">CACHE</font>','<font color="#990099">CALL</font>','<font color="#990099">CASCADE</font>','<font color="#990099">CASCADED</font>','<font color="#990099">CASE</font>','<font color="#990099">CAST</font>','<font color="#990099">CATALOG</font>','<font color="#990099">CHANGE</font>',
								            '<font color="#990099">CHAR</font>','<font color="#990099">CHARACTER</font>','<font color="#990099">CHARACTERJ^ENGTH</font>','<font color="#990099">CHECK</font>','<font color="#990099">CHECKPOINT</font>','<font color="#990099">CLOSE</font>','<font color="#990099">CLUSTER</font>',
								            '<font color="#990099">CLUSTERED</font>','<font color="#990099">COALESCE</font>','<font color="#990099">COLLATE</font>','<font color="#990099">COLUMN</font>','<font color="#990099">COLUMNS</font>','<font color="#990099">COMMENT</font>','<font color="#990099">COMMIT</font>',
								            '<font color="#990099">COMMITTED</font>','<font color="#990099">COMPUTE</font>','<font color="#990099">COMPUTED</font>','<font color="#990099">CONDITIONAL</font>','<font color="#990099">CONFIRM</font>','<font color="#990099">CONNECT</font>','<font color="#990099">CONNECTION</font>',
								            '<font color="#990099">CONSTRAINT</font>','<font color="#990099">CONSTRAINTS</font>','<font color="#990099">CONTAINING</font>','<font color="#990099">CONTAINS</font>','<font color="#990099">CONTAINSTABLE</font>','<font color="#990099">CONTINUE</font>',
								            '<font color="#990099">CONTROLROW</font>','<font color="#990099">CONVERT</font>','<font color="#990099">COPY</font>','<font color="#990099">COUNT</font>','<font color="#990099">CREATE</font>','<font color="#990099">CROSS</font>','<font color="#990099">CSTRING</font>','<font color="#990099">CUBE</font>',
								            '<font color="#990099">CURRENT</font>','<font color="#990099">CURRENT_DATE</font>','<font color="#990099">CURRENTJTIME</font>','<font color="#990099">CURRENT_TIMESTAMP</font>','<font color="#990099">CURRENT_USER',
								            '<font color="#990099">CURSOR</font>','<font color="#990099">DATABASE</font>','<font color="#990099">DATABASES</font>','<font color="#990099">DATE</font>','<font color="#990099">DATETIME</font>','<font color="#990099">DAY</font>','<font color="#990099">DBCC</font>',
								            '<font color="#990099">DEALLOCATE DECIMAL</font>','<font color="#990099"></font>','<font color="#990099">DEBUG DECLARE</font>','<font color="#990099">DEC DEFAULT</font>','<font color="#990099">DELETE</font>','<font color="#990099">DENY</font>','<font color="#990099">DESC</font>',
								            '<font color="#990099">DESCENDING DISK</font>','<font color="#990099">DIV</font>','<font color="#990099">DESCRIBE DISTINCT DO</font>','<font color="#990099">DISCONNECT DISTRIBUTED DOMAIN</font>',
								            '<font color="#990099">DOUBLE</font>','<font color="#990099">DROP</font>','<font color="#990099">DUMMY</font>','<font color="#990099">DUMP</font>','<font color="#990099">ELSE</font>','<font color="#990099">ELSEIF</font>','<font color="#990099">ENCLOSED</font>','<font color="#990099">END</font>','<font color="#990099">ERRLVL</font>',
								            '<font color="#990099">ERROREXIT</font>','<font color="#990099">ESCAPE</font>','<font color="#990099">ESCAPED</font>','<font color="#990099">EXCEPT</font>','<font color="#990099">EXCEPTION</font>','<font color="#990099">EXEC</font>','<font color="#990099">EXECUTE</font>','<font color="#990099">EXISTS</font>',
								            '<font color="#990099">EXIT</font>','<font color="#990099">EXPLAIN</font>','<font color="#990099">EXTEND</font>','<font color="#990099">EXTERNAL</font>','<font color="#990099">EXTRACT</font>','<font color="#990099">FALSE</font>','<font color="#990099">FETCH</font>','<font color="#990099">FIELD</font>','<font color="#990099">FIELDS</font>',
								            '<font color="#990099">FILE</font>','<font color="#990099">FILLFACTOR</font>','<font color="#990099">FILTER</font>','<font color="#990099">FLOAT</font>','<font color="#990099">FLOPPY</font>','<font color="#990099">FOR</font>','<font color="#990099">FORCE</font>','<font color="#990099">FOREIGN</font>','<font color="#990099">FOUND</font>',
								            '<font color="#990099">FREETEXT</font>','<font color="#990099">FREETEXTTABLE</font>','<font color="#990099">FROM</font>','<font color="#990099">FULL</font>','<font color="#990099">FUNCTION</font>','<font color="#990099">GENERATOR</font>','<font color="#990099">GET</font>','<font color="#990099">GLOBAL</font>',
								            '<font color="#990099">GO</font>','<font color="#990099">GOTO</font>','<font color="#990099">GRANT</font>','<font color="#990099">GROUP</font>','<font color="#990099">HAVING</font>','<font color="#990099">HOLDLOCK</font>','<font color="#990099">HOUR</font>','<font color="#990099">IDENTITY</font>','<font color="#990099">IF</font>','<font color="#990099">IN</font>',
								            '<font color="#990099">INACTIVE</font>','<font color="#990099">INDEX</font>','<font color="#990099">INDICATOR</font>','<font color="#990099">INFILE</font>','<font color="#990099">INNER</font>','<font color="#990099">INOUT</font>','<font color="#990099">INPUT</font>','<font color="#990099">INSENSITIVE</font>',
								            '<font color="#990099">INSERT</font>','<font color="#990099">INT</font>','<font color="#990099">INTEGER</font>','<font color="#990099">INTERSECT</font>','<font color="#990099">INTERVAL</font>','<font color="#990099">INTO</font>','<font color="#990099">IS</font>','<font color="#990099">ISOLATION</font>','<font color="#990099">JOIN</font>',
								            '<font color="#990099">KEY</font>','<font color="#990099">KILL</font>','<font color="#990099">LANGUAGE</font>','<font color="#990099">LAST</font>','<font color="#990099">LEADING</font>','<font color="#990099">LEFT</font>','<font color="#990099">LENGTH</font>','<font color="#990099">LEVEL</font>','<font color="#990099">LIKE</font>','<font color="#990099">LIMIT</font>',
								            '<font color="#990099">LINENO</font>','<font color="#990099">LINES</font>','<font color="#990099">LISTEN</font>','<font color="#990099">LOAD</font>','<font color="#990099">LOCAL</font>','<font color="#990099">LOCK</font>','<font color="#990099">LOGFILE</font>','<font color="#990099">LONG</font>','<font color="#990099">LOWER</font>','<font color="#990099">MANUAL</font>',
								            '<font color="#990099">MATCH</font>','<font color="#990099">MAX</font>','<font color="#990099">MERGE</font>','<font color="#990099">MESSAGE</font>','<font color="#990099">MIN</font>','<font color="#990099">MINUTE</font>','<font color="#990099">MIRROREXIT</font>','<font color="#990099">MODULE</font>','<font color="#990099">MONEY</font>','<font color="#990099">MONTH</font>',
								            '<font color="#990099">MOVE</font>','<font color="#990099">NAMES</font>','<font color="#990099">NATIONAL</font>','<font color="#990099">NATURAL</font>','<font color="#990099">NCHAR</font>','<font color="#990099">NEXT</font>','<font color="#990099">NEW</font>','<font color="#990099">NO</font>','<font color="#990099">NOCHECK</font>','<font color="#990099">NONCLUSTERED</font>',
								            '<font color="#990099">NONE</font>','<font color="#990099">NOT</font>','<font color="#990099">NULL</font>','<font color="#990099">NULLIF</font>','<font color="#990099">NUMERIC</font>','<font color="#990099">OF</font>','<font color="#990099">OFF</font>','<font color="#990099">OFFSET</font>','<font color="#990099">OFFSETS</font>','<font color="#990099">ON</font>','<font color="#990099">ONCE</font>','<font color="#990099">ONLY</font>',
								            '<font color="#990099">OPEN</font>','<font color="#990099">OPTION</font>','<font color="#990099">OR</font>','<font color="#990099">ORDER</font>','<font color="#990099">OUTER</font>','<font color="#990099">OUTPUT</font>','<font color="#990099">OVER</font>','<font color="#990099">OVERFLOW</font>','<font color="#990099">OVERLAPS</font>','<font color="#990099">PAD</font>','<font color="#990099">PAGE</font>',
								            '<font color="#990099">PAGES</font>','<font color="#990099">PARAMETER</font>','<font color="#990099">PARTIAL</font>','<font color="#990099">PASSWORD</font>','<font color="#990099">PERCENT</font>','<font color="#990099">PERM</font>','<font color="#990099">PERMANENT</font>','<font color="#990099">PIPE</font>','<font color="#990099">PLAN</font>',
								            '<font color="#990099">POSITION</font>','<font color="#990099">PRECISION</font>','<font color="#990099">PREPARE</font>','<font color="#990099">PRIMARY</font>','<font color="#990099">PRINT</font>','<font color="#990099">PRIOR</font>','<font color="#990099">PRIVILEGES</font>','<font color="#990099">PROC</font>',
								            '<font color="#990099">PROCEDURE</font>','<font color="#990099">PROCESSEXIT</font>','<font color="#990099">PROTECTED</font>','<font color="#990099">PUBLIC</font>','<font color="#990099">PURGE</font>','<font color="#990099">RAISERROR</font>','<font color="#990099">READ</font>','<font color="#990099">READTEXT</font>',
								            '<font color="#990099">REAL</font>','<font color="#990099">REFERENCES</font>','<font color="#990099">REGEXP</font>','<font color="#990099">RELATIVE</font>','<font color="#990099">RENAME</font>','<font color="#990099">REPEAT</font>','<font color="#990099">REPLACE</font>','<font color="#990099">REPLICATION</font>',
								            '<font color="#990099">REQUIRE</font>','<font color="#990099">RESERV</font>','<font color="#990099">RESERVING</font>','<font color="#990099">RESET</font>','<font color="#990099">RESTORE</font>','<font color="#990099">RESTRICT</font>','<font color="#990099">RETAIN</font>','<font color="#990099">RETURN</font>','<font color="#990099">RETURNS</font>',
								            '<font color="#990099">REVOKE</font>','<font color="#990099">RIGHT</font>','<font color="#990099">ROLLBACK</font>','<font color="#990099">ROLLUP</font>','<font color="#990099">ROWCOUNT</font>','<font color="#990099">RULE</font>','<font color="#990099">SAVE</font>','<font color="#990099">SAVEPOINT</font>','<font color="#990099">SCHEMA</font>',
								            '<font color="#990099">SECOND</font>','<font color="#990099">SECTION</font>','<font color="#990099">SEGMENT</font>','<font color="#990099">SELECT</font>','<font color="#990099">SENSITIVE</font>','<font color="#990099">SEPARATOR</font>','<font color="#990099">SEQUENCE</font>','<font color="#990099">SESSION_USER</font>',
								            '<font color="#990099">SET</font>','<font color="#990099">SETUSER</font>','<font color="#990099">SHADOW</font>','<font color="#990099">SHARED</font>','<font color="#990099">SHOW</font>','<font color="#990099">SHUTDOWN</font>','<font color="#990099">SINGULAR</font>','<font color="#990099">SIZE</font>','<font color="#990099">SMALLINT</font>',
								            '<font color="#990099">SNAPSHOT</font>','<font color="#990099">SOME</font>','<font color="#990099">SORT</font>','<font color="#990099">SPACE</font>','<font color="#990099">SQL</font>','<font color="#990099">SQLCODE</font>','<font color="#990099">SQLERROR</font>','<font color="#990099">STABILITY</font>','<font color="#990099">STARTING</font>',
								            '<font color="#990099">STARTS</font>','<font color="#990099">STATISTICS</font>','<font color="#990099">SUBSTRING</font>','<font color="#990099">SUM</font>','<font color="#990099">SUSPEND</font>','<font color="#990099">TABLE</font>','<font color="#990099">TABLES</font>','<font color="#990099">TAPE</font>','<font color="#990099">TEMP</font>',
								            '<font color="#990099">TEMPORARY</font>','<font color="#990099">THEN</font>','<font color="#990099">TO</font>','<font color="#990099">TRAN</font>','<font color="#990099">TRIGGER</font>','<font color="#990099">TRUNCATE</font>','<font color="#990099">UNIQUE</font>','<font color="#990099">UPDATETEXT</font>','<font color="#990099">USE</font>','<font color="#990099">VALUE</font>',
								            '<font color="#990099">VARIABLE</font>','<font color="#990099">VIEW</font>','<font color="#990099">WAITFOR</font>','<font color="#990099">WHILE</font>','<font color="#990099">WRITE</font>','<font color="#990099">YEAR</font>','<font color="#990099">TEXT</font>','<font color="#990099">TIME</font>','<font color="#990099">TOP</font>','<font color="#990099">TRANSACTION</font>',
								            '<font color="#990099">TRIM</font>','<font color="#990099">UNCOMMITTED</font>','<font color="#990099">UNTIL</font>','<font color="#990099">UPPER</font>','<font color="#990099">USER</font>','<font color="#990099">VALUES</font>','<font color="#990099">VARYING</font>','<font color="#990099">VOLUME</font>','<font color="#990099">WHEN</font>','<font color="#990099">WITH</font>',
								            '<font color="#990099">WRITETEXT</font>','<font color="#990099">ZONE</font>','<font color="#990099">TEXTSIZE</font>','<font color="#990099">TIMESTAMP</font>','<font color="#990099">TRAILING</font>','<font color="#990099">TRANSLATE</font>','<font color="#990099">TRUE</font>','<font color="#990099">UNION</font>','<font color="#990099">UPDATE</font>',
								            '<font color="#990099">USAGE</font>','<font color="#990099">USING</font>','<font color="#990099">VARCHAR</font>','<font color="#990099">VERBOSE</font>','<font color="#990099">WAIT</font>','<font color="#990099">WHERE</font>','<font color="#990099">WORK</font>','<font color="#990099">XOR</font>');
	print_r('<pre>Ошибка в запросе: <b>');
	$query = explode(" ", $q);
	foreach($query as $key => $val)
	{
	    $value = $val;
		if(trim($val) == 'ORDER' || trim($val) == 'UPDATE')
		{
			$value = str_replace(trim($val), '<font color="#990099">'.trim($val).'</font>', trim($val));
		};
		$value2 = str_replace($reserved_sql_words, $reserved_sql_words_replacement, $value);
		$query2[$key] = preg_replace('!`(.*?)`!si','<font color="#FF9900">`\\1`</font>',$value2);
	}
	$value = implode(" ", $query2);
    print_r($value);
    print_r('</b></pre>');
    if($die) die;
}

/**
 * Преобразование результата работы выборки функции в ассоциативный массив
 *
 * @param recordset $rs набор строк - результат работы SELECT
 * @return array 
 */
function createSmartyRsArray($rs) {
    if( ! $rs)
        return false;
    
    $smartyRs = array();
    while ($row = mysql_fetch_assoc($rs)) {
        $smartyRs[] = $row;
    }
    
    return $smartyRs;
}

/**
 * Функция для загрузки файлов на сервер
 *
 * @param string $name Имя файла
 * @param file $file Загружаемый файл
 * @param string $ext Расширение файла
 * @param string $type Документ или аватар
 * @param string $title Название документа
 * @return string Сообщение об итоге операции
 */
function uploadFile($name, $file, $ext, $type="file", $title="") {
	$dir_ext = 'none';
	
    $actual_image_name = $name.'.'.$ext;
	$tmp = $file['tmp_name'];
	
	$img = array('jpg', 'jpeg', 'JPG', 'JPEG', 'gif', 'GIF', 'tiff', 'TIF', 'png', 'PNG', 'bmp', 'BMP');
	$arch = array('zip', 'ZIP', 'rar', 'RAR', 'tar', 'TAR', 'gz', 'GZ', 'iso', 'ISO');
	$docs = array('txt', 'TXT', 'doc', 'DOC', 'docx', 'DOCX');
	$ps = array('psd', 'PSD');
	$video = array('mp4', 'MP4', 'avi', 'AVI', 'mpeg', 'MPEG', 'xvid', 'XVID', 'divx', 'DIVX');
	$pdf = array('pdf', 'PDF');
	
	$keys = array('doc', 'pdf', 'zip', 'psd', 'png', 'avi');
	$extt = array($docs, $pdf, $arch, $ps, $img, $video);
	
	foreach($extt as $key => $val)
	{
	    foreach($val as $key2 => $val2)
		{
		    if($ext == $val2)
			{
			    $dir_ext = $keys[$key];
				break;
			}
		}
		if($dir_ext != 'none') break;
	}
	
	$dir = 'none';
	
	if($type == 'file') {
	    $dir = 'documents/'.$dir_ext;
	} else {
	    $type == 'settings' ? $dir = 'documents' : $dir = 'documents/'.$type;
	}
	
    // Если папка не существует - создаём её, притом с правами 777
    if (!is_dir($dir)) mkdir($dir, 0777);
    
	// Удаляем файлы с тем же именем, что и этот(защита от дублей)
	foreach($img as $key => $val)
	{
	    unlink($dir.'/'.$name.'.'.$val);
	}
	
    //Загружаем файл в папку
    if(move_uploaded_file($tmp, $dir.'/'.$actual_image_name))
	{
		if($type == 'news' || $type == 'games' || $type == 'shop') squarephoto($actual_image_name, $dir, 450);
		return "<span style='color: #00AA66;'>Файл успешно загружен!</span>";
    } else {
        return "<span style='color: #AA0000;'>Ошибка. Файл не был загружен!</span>";
	}
}

/*
 * Обрезка иконок услуг
 *
 * @param string $name Имя картинки
 * @param string $ext Расширение файла картинки
 */
function squarephoto($name, $dir, $to)
{
	require_once("SimpleImage.class.php");
    $image = new SimpleImage();
	$image->load($dir.'/'.$name);
	$image->crop($to);
	$image->save($dir.'/'.$name);
}

/**
 * Обрезка длинного текста до n символов
 *
 * @param string $string Исходная строка
 * @param integer $maxlen До какого количества символов нужно обрезать
 * @return string $cutStr Обрезанная строка
 */
function cutString($string, $maxlen)
{
	if(trim($string) != '')
	{
	    //$string = stripslashes(strip_tags($string));
	    $len = (mb_strlen($string) > $maxlen) ? mb_strripos(mb_substr($string, 0, $maxlen), ' ') : $maxlen;
        $cutStr = mb_substr($string, 0, $len);
        return (mb_strlen($string) > $maxlen) ? $cutStr.'...' : $cutStr;
	} else {
	    return $string;
	}
}

/*
 * Обрабатываем текст перед тем, как занести его в базу
 * @param $txt string Исходная строка
 * @return string $txt Обработанная строка
 */
function sip($txt)
{
    global $mysqli;
    $txt = $mysqli->real_escape_string($txt);
    $txt = strip_tags($txt);
    $txt = htmlspecialchars($txt);
    $txt = stripslashes($txt);
    $txt = addslashes($txt);
    return $txt;
}

/*
 * Убираем экранирование из данных БД перед показом на странице
 * @param $txt string строка из БД
 * @return string $txt Обработанная строка
 */
function isip($txt)
{
    $txt = htmlspecialchars_decode($txt);
    $txt = stripslashes($txt);
    return html_entity_decode($txt);
}

/*
 * TimeStamp в читаемом виде
 * 
 * @return string $date Время в читаемом виде
 */
function timeNow()
{
		$dt = new DateTime();
		$now = $dt->format('H:i');
        $td = date('d').'.'.date('m').'.'.date('Y');
		$date = $td.' - '.$now;
		
	return $date;
}

/*
 * Переводим дату из UNIXTIMESTAMP в читаемый вид
 * @param $date string
 * @return string Время в читаемом виде
 */
function normaldate($date)
{
    $date = new DateTime($date);
	return $date->format('Y-m-d');
}

/*
 * Переводим дату из дд.мм.гггг в день и название месяца
 * @param $date string дата в формате дд.мм.гггг
 * @return $rusdate string Число и название месяца
 */
function rusdate($date)
{
    /*$trans = array("01" => "января",
                   "02" => "февраля",
                   "03" => "марта",
                   "04" => "апреля",
                   "05" => "мая",
                   "06" => "июня",
                   "07" => "июля",
                   "08" => "августа",
                   "09" => "сентября",
                   "10" => "октября",
                   "11" => "ноября",
                   "12" => "декабря"
                   );*/
				   
	$onlydate = explode(" ", $date);
	$date_part = explode("-", $onlydate[0]);
	/*$day_1 = mb_substr($date_part[2], 0, 1, 'UTF-8');
	$day_2 = mb_substr($date_part[2], 1, 2, 'UTF-8');
	if((int)$day_1 > 0 && (int)$day_2 >= 0)
	{
        $day = $day_1.$day_2;
	} else {
	    $day_3 = explode("0", $date_part[2]);
	    
		if(trim($day_3[2]) == '')
		{
		    $n = 1;
			$delim = '&nbsp;';
		} else {
		    $n = 0;
			$delim = '';
		}
		
		$day = $delim.$day_3[$n];
	}*/
	//$rusdate = $day.' '.strtr($date_part[1], $trans).' '.$date_part[0].', в '.mb_substr($onlydate[1], 0, 5, 'UTF-8');
	$rusdate = $date_part[2].'.'.$date_part[1].'.'.$date_part[0];
	return $rusdate;
}

/*
 * Переводим кириллицу в транслит
 * @param $string string Строка с русскими символами
 * @return string Строка в транслите
 */
function rus2translit($string)
{
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}

/*
 * Формируем ЧПУ из строки, переведённой в транслит
 * @param $str string Исходная строка в транслите
 * @return $str string Изменённая строка для вставки в адресную строку
 */
function str2url($str)
{
	$str = rus2translit($str);
    $str = strtolower($str);
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
	$str = trim($str);
    $str = trim($str, "-");
	$pos = strpos($str, "-");
	if($pos === false) $str = '-'.$str;
	
    return $str;
}

/*
 * Формируем ЧПУ из строки, переведённой в транслит
 * @param $str string Исходная строка в транслите
 * @param string $tbl Таблица по которой ищем совпадения URL, чтобы дать уникальный URL
 * @return $str string Изменённая строка для вставки в адресную строку
 */
function str2url2($str, $tbl)
{
	global $mysqli;
	$allcount = 0;
	$str = rus2translit($str);
    $str = strtolower($str);
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
	$str = trim($str);
    $str = trim($str, "-");
	
	$res = $mysqli->query("SELECT `id` AS id FROM `{$tbl}` WHERE `url`='{$str}'");
	$cnt = (int)$res->num_rows;
	$all_count += $cnt;
	$res->close();
	
	$res = $mysqli->query("SELECT `id` AS id FROM `{$tbl}` WHERE `url` LIKE '{$str}-%'");
	$cnt2 = (int)$res->num_rows;
	$all_count += $cnt2;
	
	if($all_count > 1)
	{
	    $str = $str.'-'.($all_count);
	} else {
	    $str = $str;
	}
	$res->close();
	
    return $str;
}

/*
 * Вытаскиваем из текста первые одно-два предложения
 * @param $str string Исходная строка
 * @param $num integer Количество символов для предварительной обрезки текста
 * @return $str string Изменённая строка
 */
function croptext($str, $num)
{
	if(trim($str) != '')
	{
	    $separator = array('?', '!', '.');
	    $str = preg_replace("'<pre[^>]*?>.*?</pre>'si", "",$str);
		$str2 = $str;
		$str = strip_tags($str);
	    $str = substr($str, 0, $num);
	
        $i = strlen($str);
        do{
            $i--;
        }while(!in_array($str[$i], $separator) && $i >= 0);
	
        $string = substr($str, 0, ($i+1));
	
	    (strlen($string) <= 1) ? $str = cutString($str2, $num) : $str = $string;
	
	    return html_entity_decode($str);
	} else {
	    return $str;
	}
}

/*
 * Вытаскиваем из текста первые одно-два предложения без обрезки тегов
 * @param $str string Исходная строка
 * @param $num integer Количество символов для предварительной обрезки текста
 * @return $str string Изменённая строка
 */
function croptext2($str, $num)
{
	if(trim($str) != '')
	{
	    $separator = array('?', '!', '.');
	    $str2 = $str;
	    $str = substr($str, 0, $num);
	
        $i = strlen($str);
        do{
            $i--;
        }while(!in_array($str[$i], $separator) && $i >= 0);
	
        $string = substr($str, 0, ($i+1));
	
	    (strlen($string) <= 1) ? $str = cutString($str2, $num) : $str = $string;
	
	    return html_entity_decode($str);
	} else {
	    return $str;
	}
}

/**
 * Узнаём текущий URL страницы
 */
function curPageURL()
{
    $pageURL = 'http';
	
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $pageURL .= "s";
    $pageURL .= "://";
	
    if ($_SERVER["SERVER_PORT"] != "80")
	{
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
	
    return $pageURL;
}

/* Реструктурируем массив файлов для их последовательной загрузки на сервер
 *
 */
function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

/**
 * Проверяем переменную или одномерный массив на пустоту
 *
 * @param string/array $a Входное значение
 * @return integer Пустое/не пустое
 */
function it($a)
{
    if(is_array($a))
	{
	    foreach($a as $key => $val)
		{
			if(trim($key) == 'worklink' || trim($key) == 'worklink_text')
			{
			    $it = true;
			} else {
				if(isset($a[$key]) && trim($a[$key]) != '')
			    {
			        $it = true;
			    } else {
			        $it = false;
			    	break;
			    }
			}
		}
	} else {
	    (isset($a) && trim($a) != '') ? $it = true : $it = false;
	}
	return $it;
}

/**
 * Создаём список всех экшнов сайта
 *
 * @param string $no_error Контроллер-исключение(по умолчанию Admin)
 * @param array $controllers - Список всех контроллеров в виде массива(формируется в config/config.php)
 * @param string $path - Куда сохранить список экшнов.
 */
function actions_list($no_error, $controllers, $path) {
    $i = 0;

	foreach($controllers as $key => $val)
    {
    	if(trim($val) != trim($no_error.'Controller.php'))
    	{
    	    $arr = file('../controllers/'.$val);
    	    foreach($arr as $key2 => $val2)
    	    {
    	    	if(strpos($arr[$key2], 'Action') !== false)
                {
    	    	    $act1 = explode("function ", $arr[$key2]);
    	    	    $act2 = explode("Action", $act1[1]);
                    $arr2[$i] = $act2[0];
					$i++;
                };
    	    }
    	};
    }
	
	unset($arr);
	$arr = array_unique($arr2);
    $all = "";
	
	foreach($arr as $key => $val)
	{
		$all .= $val."\n";
	}
	
	file_put_contents($path, $all);
}

/**
 * Функционал страницы ошибки 404
 *
 * @param string $no_error Контроллер-исключение(по умолчанию Admin)
 * @param string $no_error2 Контроллер-исключение2(по умолчанию Page)
 * @param string $controllerName Имя текущего контроллера
 * @param string $actionName Имя текущего экшна
 * @param array $controllers Список всех контроллеров
 */
function error_404($no_error, $no_error2, $controllerName, $actionName, $controllers) {
	if($controllerName != $no_error && $controllerName != $no_error2)
    {
        foreach($controllers as $key => $val)
        {
            if($val == $controllerName.'Controller.php')
        	{
        	    $ok = 1;
        		break;
        	}
        }
        
        $arr = file('../config/actions.ini');
        foreach($arr as $key => $val)
        {
        	if(trim($arr[$key]) == $actionName)
        	{
        	    $ok2 = 1;
        		break;
        	}
        }

        if(!isset($ok) || $ok != 1) 
        {
            echo '<script type="text/javascript">
        		      document.location.href = "/error/";
        		  </script>';
        } else {
            if(!isset($ok2) || $ok2 != 1)
        	{
                echo '<script type="text/javascript">
        	    	      document.location.href = "/error/";
        	    	  </script>';
        	};
        }
    }
}

/**
 * Информация по URL
 * 
 * @param string/integer $url URL
 * @param string/integer $tbl Имя таблицы
 * @return array $info Массив с информацией
 */
function InfoByUrl($url, $tbl) {
	$info = select($tbl, "`url`='{$url}'");
	return $info;
}

/**
 * Склонение слов относительно их количества(указываем 3 формы слова)
 * 
 * @example echo rustxt('число', 'числа', 'чисел', $count);
 *
 * @param string $word1 единственное число
 * @param string $word2 от 2 до 4 включительно
 * @param string $word3 5 и более
 * @param integer $count количество
 *
 * @return string $plural "склонённое" слово
 */
function rustxt($word1, $word2, $word3, $n) {
    $plural = $n%10==1&&$n%100!=11?$word1:($n%10>=2&&$n%10<=4&&($n%100<10||$n%100>=20)?$word2:$word3);
	return $plural;
}