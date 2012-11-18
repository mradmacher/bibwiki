<?php class SpecialBibWiki extends SpecialPage {
  protected $searchPath = 'Special:BibWikiSearch';
  protected $editPath = 'Special:BibWikiEdit';
  protected $createPath = 'Special:BibWikiCreate';
  //private $deletePath = '/Special:BibWikiDelete';
  protected $importPath = 'Special:BibWikiImport';
  protected $adminPath = 'Special:BibWikiAdmin';

  const PARAM_PREFIX = 'pub_';

  protected $printable = false;

  const PROPERTY_PREFIX = 'Publication ';
  const MAIN_CATEGORY_NAME = 'Publication';
  const TEMPLATE_NAME = 'Publication';

  const TYPE = 'type';

  const ID = 'id';

  const ADDRESS = 'address';
  const ANNOTE = 'annote';
  const AUTHOR = 'author';
  const BOOKTITLE = 'booktitle';
  const CHAPTER = 'chapter';
  const CROSSREF = 'crossref';
  const EDITION = 'edition';
  const EDITOR = 'editor';
  const EPRINT = 'eprint';
  const HOWPUBLISHED = 'howpublished';
  const INSTITUTION = 'institution';
  const JOURNAL = 'journal';
  const MONTH = 'month';
  const NOTE = 'note';
  const NUMBER = 'number';
  const ORGANIZATION = 'organization';
  const PAGES = 'pages';
  const PUBLISHER = 'publisher';
  const SCHOOL = 'school';
  const SERIES = 'series';
  const TITLE = 'title';
  const TYPEDESC = 'typedesc';
  const URL = 'url';
  const VOLUME = 'volume';
  const YEAR = 'year';
  const KEYWORDS = 'keywords';

  const TYPE_ARTICLE = 'article';
  const TYPE_BOOK = 'book';
  const TYPE_BOOKLET = 'booklet';
  const TYPE_INBOOK = 'inbook';
  const TYPE_INCOLLECTION = 'incollection';
  const TYPE_INPROCEEDINGS = 'inproceedings';
  const TYPE_MANUAL = 'manual';
  const TYPE_MASTERSTHESIS = 'mastersthesis';
  const TYPE_MISC = 'misc';
  const TYPE_PHDTHESIS = 'phdthesis';
  const TYPE_PROCEEDINGS = 'proceedings';
  const TYPE_TECHREPORT = 'techreport';
  const TYPE_UNPUBLISHED = 'unpublished';

  protected $fields = array(
    self::AUTHOR,
    self::TITLE,
    self::YEAR,
    self::PUBLISHER,
    self::JOURNAL,
    self::NOTE,
    self::BOOKTITLE,
    self::CHAPTER,
    self::EDITION,
    self::EDITOR,
    self::EPRINT,
    self::HOWPUBLISHED,
    self::INSTITUTION,
    self::MONTH,
    self::NUMBER,
    self::VOLUME,
    self::PAGES,
    self::ORGANIZATION,
    self::ADDRESS,
    self::SCHOOL,
    self::SERIES,
    self::TYPEDESC,
    self::CROSSREF,
    self::URL,
//    self::ANNOTE,
    self::KEYWORDS
    );

  protected $tex2wikiFields = array(
    'author'        => self::AUTHOR,
    'title'         => self::TITLE,
    'year'          => self::YEAR,
    'publisher'     => self::PUBLISHER,
    'journal'       => self::JOURNAL,
    'note'          => self::NOTE,
    'booktitle'     => self::BOOKTITLE,
    'chapter'       => self::CHAPTER,
    'edition'       => self::EDITION,
    'editor'        => self::EDITOR,
    'eprint'        => self::EPRINT,
    'howpublished'  => self::HOWPUBLISHED,
    'institution'   => self::INSTITUTION,
    'month'         => self::MONTH,
    'number'        => self::NUMBER,
    'volume'        => self::VOLUME,
    'pages'         => self::PAGES,
    'organization'  => self::ORGANIZATION,
    'address'       => self::ADDRESS,
    'school'        => self::SCHOOL,
    'series'        => self::SERIES,
    'type'          => self::TYPEDESC,
    'crossref'      => self::CROSSREF,
    'url'           => self::URL,
    'annote'        => self::ANNOTE,
    'keywords'      => self::KEYWORDS
    );

  protected $tex2wikiTypeField = 'entrytype'; 
  protected $tex2wikiTypes = array(
    '@article'        => self::TYPE_ARTICLE,
    '@book'           => self::TYPE_BOOK,
    '@booklet'        => self::TYPE_BOOKLET,
    '@inbook'         => self::TYPE_INBOOK,
    '@incollection'   => self::TYPE_INCOLLECTION,
    '@inproceedings'  => self::TYPE_INPROCEEDINGS,
    '@manual'         => self::TYPE_MANUAL,
    '@mastersthesis'  => self::TYPE_MASTERSTHESIS,
    '@misc'           => self::TYPE_MISC,
    '@phdthesis'      => self::TYPE_PHDTHESIS,
    '@proceedings'    => self::TYPE_PROCEEDINGS,
    '@techreport'     => self::TYPE_TECHREPORT,
    '@unpublished'    => self::TYPE_UNPUBLISHED,
    '@conference'     => self::TYPE_INPROCEEDINGS );

  protected $fieldTypes = array(
    self::ADDRESS => 'string',
    self::ANNOTE => 'text',
    self::AUTHOR => 'string',
    self::BOOKTITLE => 'string',
    self::CHAPTER => 'string',
    self::CROSSREF => 'page',
    self::EDITION => 'string',
    self::EDITOR => 'string',
    self::EPRINT => 'string',
    self::HOWPUBLISHED => 'string',
    self::INSTITUTION => 'string',
    self::JOURNAL => 'string',
    self::MONTH => 'string',
    self::NOTE => 'text',
    self::NUMBER => 'string',
    self::ORGANIZATION => 'string',
    self::PAGES => 'string',
    self::PUBLISHER => 'string',
    self::SCHOOL => 'string',
    self::SERIES => 'string',
    self::TITLE => 'string',
    self::TYPEDESC => 'string',
    self::URL => 'URL',
    self::VOLUME => 'string',
    self::YEAR => 'string',
    self::KEYWORDS => 'string' );

  protected $fieldNames = array(
    self::ADDRESS => 'Address',
    self::ANNOTE => 'Annotation',
    self::AUTHOR => 'Author',
    self::BOOKTITLE => 'Book Title',
    self::CHAPTER => 'Chapter',
    self::CROSSREF => 'Cross-referenced Key',
    self::EDITION => 'Edition',
    self::EDITOR => 'Editor',
    self::EPRINT => 'Eprint',
    self::HOWPUBLISHED => 'How Published',
    self::INSTITUTION => 'Institution',
    self::JOURNAL => 'Journal',
    self::MONTH => 'Month',
    self::NOTE => 'Note',
    self::NUMBER => 'Number',
    self::ORGANIZATION => 'Organization',
    self::PAGES => 'Pages',
    self::PUBLISHER => 'Publisher',
    self::SCHOOL => 'School',
    self::SERIES => 'Series',
    self::TITLE => 'Title',
    self::TYPEDESC => 'Type Description',
    self::URL => 'URL',
    self::VOLUME => 'Volume',
    self::YEAR => 'Year',
    self::KEYWORDS => 'Keywords');

  protected $fieldDescs = array(
    self::ADDRESS => 'Publisher\'s address (usually just the city, but can be the full address for lesser-known publishers)',
    self::ANNOTE => 'An annotation for annotated bibliography styles (not typical)',
    self::AUTHOR => 'The name(s) of the author(s) (in the case of more than one author, separated by and)',
    self::BOOKTITLE => 'The title of the book, if only part of it is being cited',
    self::CHAPTER => 'The chapter number',
    self::CROSSREF => 'The key of the cross-referenced entry',
    self::EDITION => 'The edition of a book, long form (such as "first" or "second")',
    self::EDITOR => 'The name(s) of the editor(s)',
    self::EPRINT => 'A specification of an electronic publication, often a preprint or a technical report',
    self::HOWPUBLISHED => 'How it was published, if the publishing method is nonstandard',
    self::INSTITUTION => 'The institution that was involved in the publishing, but not necessarily the publisher',
    self::JOURNAL => 'The journal or magazine the work was published in',
#    key => 'A hidden field used for specifying or overriding the alphabetical order of entries (when the "author" and "editor" fields are missing). Note that this is very different from the key that is used to cite or cross-reference the entry.',
    self::MONTH => 'The month of publication (or, if unpublished, the month of creation)',
    self::NOTE => 'Miscellaneous extra information',
    self::NUMBER => 'The "(issue) number" of a journal, magazine, or tech-report, if applicable. (Most publications have a "volume", but no "number" field.)',
    self::ORGANIZATION => 'The conference sponsor',
    self::PAGES => 'Page numbers, separated either by commas or double-hyphens',
    self::PUBLISHER => 'The publisher\'s name',
    self::SCHOOL => 'The school where the thesis was written',
    self::SERIES => 'The series of books the book was published in (e.g. "The Hardy Boys" or "Lecture Notes in Computer Science")',
    self::TITLE => 'The title of the work',
    self::TYPEDESC => 'The field overriding the default type of publication (e.g. "Research Note" for techreport, "{PhD} dissertation" for phdthesis, "Section" for inbook/incollection)',
    self::URL => 'The WWW address',
    self::VOLUME => 'The volume of a journal or multi-volume book',
    self::YEAR => 'The year of publication (or, if unpublished, the year of creation)',
    self::KEYWORDS => 'Keywords separated by commas');

  protected $entryTypes = array( self::TYPE_ARTICLE, self::TYPE_BOOK, self::TYPE_BOOKLET, self::TYPE_INBOOK,
    self::TYPE_INCOLLECTION, self::TYPE_INPROCEEDINGS, self::TYPE_MANUAL, self::TYPE_MASTERSTHESIS, self::TYPE_MISC,
    self::TYPE_PHDTHESIS, self::TYPE_PROCEEDINGS, self::TYPE_TECHREPORT, self::TYPE_UNPUBLISHED );

  protected $entryTypeNames = array(
    self::TYPE_ARTICLE => 'Article', 
    self::TYPE_BOOK => 'Book',
    self::TYPE_BOOKLET => 'Booklet',
    self::TYPE_INBOOK => 'Inbook',
    self::TYPE_INCOLLECTION => 'Incollection',
    self::TYPE_INPROCEEDINGS => 'Inproceedings',
    self::TYPE_MANUAL => 'Manual',
    self::TYPE_MASTERSTHESIS => 'Master\'s thesis',
    self::TYPE_MISC => 'Miscellaneous',
    self::TYPE_PHDTHESIS => 'Ph.D. Thesis',
    self::TYPE_PROCEEDINGS => 'Proceedings',
    self::TYPE_TECHREPORT => 'Technical Report',
    self::TYPE_UNPUBLISHED => 'Unpublished' );

  protected $entryTypeDescs = array(
    self::TYPE_ARTICLE => 'An article from a journal or magazine.', 
    self::TYPE_BOOK => 'A book with an explicit publisher.',
    self::TYPE_BOOKLET => 'A work that is printed and bound, but without a named publisher or sponsoring institution.',
    self::TYPE_INBOOK => 'A part of a book, usually untitled. May be a chapter (or section or whatever) and/or a range of pages.',
    self::TYPE_INCOLLECTION => 'A part of a book having its own title.',
    self::TYPE_INPROCEEDINGS => 'An article in a conference proceedings.',
    self::TYPE_MANUAL => 'Technical documentation.',
    self::TYPE_MASTERSTHESIS => 'A Master\'s thesis.',
    self::TYPE_MISC => 'For use when nothing else fits.',
    self::TYPE_PHDTHESIS => 'A Ph.D. thesis.',
    self::TYPE_PROCEEDINGS => 'The proceedings of a conference.',
    self::TYPE_TECHREPORT => 'A report published by a school or other institution, usually numbered within a series.',
    self::TYPE_UNPUBLISHED => 'A document having an author and title, but not formally published.' );

  protected $entryTypeFields = array(
    self::TYPE_ARTICLE => array( 
        'required' => array( self::AUTHOR, self::TITLE, self::JOURNAL, self::YEAR ),
        'optional' => array( self::VOLUME, self::NUMBER, self::PAGES, self::MONTH, self::NOTE, self::KEYWORDS ) 
        ),
    self::TYPE_BOOK => array( 
        'required' => array( self::AUTHOR, self::EDITOR, self::TITLE, self::PUBLISHER, self::YEAR ),
        'optional' => array( self::VOLUME, self::NUMBER, self::SERIES, self::ADDRESS, self::EDITION, self::MONTH, self::NOTE, self::KEYWORDS ) 
        ),
    self::TYPE_BOOKLET => array( 
        'required' => array( self::TITLE ),
        'optional' => array( self::AUTHOR, self::HOWPUBLISHED, self::ADDRESS, self::MONTH, self::YEAR, self::NOTE, self::KEYWORDS ) 
        ),
    self::TYPE_INBOOK => array( 
        'required' => array( self::AUTHOR, self::EDITOR, self::TITLE, self::CHAPTER, self::PAGES, self::PUBLISHER, self::YEAR ),
        'optional' => array( self::VOLUME, self::NUMBER, self::SERIES, self::TYPEDESC, self::ADDRESS, self::EDITION, self::MONTH, self::NOTE, self::KEYWORDS ) 
        ),
    self::TYPE_INCOLLECTION => array( 
        'required' => array( self::AUTHOR, self::TITLE, self::BOOKTITLE, self::PUBLISHER, self::YEAR ),
        'optional' => array( self::EDITOR, self::VOLUME, self::NUMBER, self::SERIES, self::TYPEDESC, self::CHAPTER, self::PAGES, self::ADDRESS, self::EDITION, self::MONTH, self::NOTE, self::KEYWORDS )
        ),
    self::TYPE_INPROCEEDINGS => array( 
        'required' => array( self::AUTHOR, self::TITLE, self::BOOKTITLE, self::YEAR ),
        'optional' => array( self::EDITOR, self::VOLUME, self::NUMBER, self::SERIES, self::PAGES, self::ADDRESS, self::MONTH, self::ORGANIZATION, self::PUBLISHER, self::NOTE, self::KEYWORDS ) 
        ),
    self::TYPE_MANUAL => array(
        'required' => array( self::TITLE ),
        'optional' => array( self::AUTHOR, self::ORGANIZATION, self::ADDRESS, self::EDITION, self::MONTH, self::YEAR, self::NOTE, self::KEYWORDS )
        ),
    self::TYPE_MASTERSTHESIS => array(
        'required' => array( self::AUTHOR, self::TITLE, self::SCHOOL, self::YEAR ),
        'optional' => array( self::TYPEDESC, self::ADDRESS, self::MONTH, self::NOTE, self::KEYWORDS ),
        ),
    self::TYPE_MISC => array(
        'required' => array(),
        'optional' => array( self::AUTHOR, self::TITLE, self::HOWPUBLISHED, self::MONTH, self::YEAR, self::NOTE, self::KEYWORDS )
        ),
    self::TYPE_PHDTHESIS => array(
        'required' => array( self::AUTHOR, self::TITLE, self::SCHOOL, self::YEAR ),
        'optional' => array( self::TYPEDESC, self::ADDRESS, self::MONTH, self::NOTE, self::KEYWORDS )
        ),
    self::TYPE_PROCEEDINGS => array(
        'required' => array( self::TITLE, self::YEAR ),
        'optional' => array( self::EDITOR, self::VOLUME, self::NUMBER, self::SERIES, self::ADDRESS, self::MONTH, self::PUBLISHER, self::ORGANIZATION, self::NOTE, self::KEYWORDS )
        ),
    self::TYPE_TECHREPORT => array(
        'required' => array( self::AUTHOR, self::TITLE, self::INSTITUTION, self::YEAR ),
        'optional' => array( self::TYPEDESC, self::NUMBER, self::ADDRESS, self::MONTH, self::NOTE, self::KEYWORDS )
        ),
    self::TYPE_UNPUBLISHED => array(
        'required' => array( self::AUTHOR, self::TITLE, self::NOTE ),
        'optional' => array( self::MONTH, self::YEAR, self::KEYWORDS )
        )
    );

  protected $fieldOptions = array(
      self::ADDRESS => array( 'type' => 'string', 'size' => 80 ),
      self::ANNOTE => array( 'type' => 'text', 'cols' => 60, 'rows' => 20 ),
      self::AUTHOR => array( 'type' => 'string', 'size' => 80 ),
      self::BOOKTITLE => array( 'type' => 'string', 'size' => 80 ),
      self::CHAPTER => array( 'type' => 'string', 'size' => 80 ),
      self::CROSSREF => array( 'type' => 'string', 'size' => 80 ),
      self::EDITION => array( 'type' => 'string', 'size' => 80 ),
      self::EDITOR => array( 'type' => 'string', 'size' => 80 ),
      self::EPRINT => array( 'type' => 'string', 'size' => 80 ),
      self::HOWPUBLISHED => array( 'type' => 'string', 'size' => 80 ),
      self::INSTITUTION => array( 'type' => 'string', 'size' => 80 ),
      self::JOURNAL => array( 'type' => 'string', 'size' => 80 ),
      'KEY' => array( 'type' => 'string', 'size' => 10 ),
      self::MONTH => array( 'type' => 'string', 'size' => 10 ),
      self::NOTE => array( 'type' => 'text', 'cols' => 60, 'rows' => 20 ),
      self::NUMBER => array( 'type' => 'string', 'size' => 20 ),
      self::ORGANIZATION => array( 'type' => 'string', 'size' => 80 ),
      self::PAGES => array( 'type' => 'string', 'size' => 10 ),
      self::PUBLISHER => array( 'type' => 'string', 'size' => 80 ),
      self::SCHOOL => array( 'type' => 'string', 'size' => 80 ),
      self::SERIES => array( 'type' => 'string', 'size' => 80 ),
      self::TITLE => array( 'type' => 'string', 'size' => 80 ),
      self::TYPEDESC => array( 'type' => 'string', 'size' => 40 ),
      self::URL => array( 'type' => 'string', 'size' => 80 ),
      self::VOLUME => array( 'type' => 'string', 'size' => 20 ),
      self::YEAR => array( 'type' => 'string', 'size' => 4 ),
      self::KEYWORDS => array( 'type' => 'string', 'size' => 80 ) );

  protected $searcheableFields = array( self::AUTHOR, self::TITLE, self::PUBLISHER, self::JOURNAL, self::YEAR, self::KEYWORDS );

  function __construct( $name ) {
    parent::__construct( $name );
  }

  protected function toParamName( $key ) {
    return self::PARAM_PREFIX . $key;
  }
  protected function toPropertyName( $field ) {
    return self::PROPERTY_PREFIX . $field;
  }
  protected function toTypeCategoryName( $type ) {
    return $type;
  }

  protected function linkToMainCategory() {
    return '[[Category:' . self::MAIN_CATEGORY_NAME . ']]';
  }
  protected function linkToTypeCategory( $type ) {
    return '[[Category:' . $type . ']]';
  }
  protected function linkToSearch() {
    return '[[' . $this -> searchPath . '|Search]]';
  }
  protected function linkToImport() {
    return '[[' . $this -> importPath . '|Import]]';
  }
  protected function linkToCreate( $type = '' ) {
    if( $type == '' ) {
      return '[[' . $this -> createPath . '|Create]]';
    } else {
      return '[[' . $this -> createPath . '/' . $type . '|' . $this -> entryTypeNames[ $type ] . ']]';
    }
  }
  protected function linkToEdit( $id ) {
    return '[[' . $this -> editPath . '/' . $id . '|Edit]]';
  }
  protected function linkToShow( $id ) {
    return '[[' . $id . '|Show]]';
  }

  protected function getCSS() {
    $css = '';
    $css .= 'form.bibwiki-search {display: inline; margin-right: 5px;}';
    $css .= '.bibwiki-search input[type=submit]{width: 62px;}';
    $css .= '.bibwiki-search label {display: inline-table; width: 70px; text-align: right; margin-right: 5px;}';
    $css .= '.bibwiki-search input {margin-bottom: 1px;}';
    $css .= '.bibwiki-search label:after {content: ":";}';
    $css .= '.bibwiki-link {margin-right: 5px;}';
    $css .= '.bibwiki-table {border-collapse: collapse; border 1px solid}';
    $css .= '.bibwiki-table td {padding-right: 5px; text-align: left; vertical-align: top;}';
    return $css;
  }

  function execute( $par ) {
    global $wgRequest, $wgOut, $wgUser;
    $this -> setHeaders();
    if( !$wgUser -> isLoggedIn() ) {
      $this -> displayRestrictionError();
    }
    $this -> printable = false;
    if( $wgRequest -> getText( 'printable' ) == 'yes' ) {
      $this -> printable = true;
    }
    $wgOut -> addInlineStyle( $this -> getCSS() );
  }
  function isPrintable() {
    return $this -> printable;
  }

  function getSearchForm( $criteria ) {
    global $wgScriptPath;
    $html = '<br />';
    $html .= '<form class="bibwiki-search" action="' . $wgScriptPath . '/' . $this -> searchPath . '" method="get">';
    foreach( $this -> searcheableFields as $field ) {
      $html .= '<label for="' . $this -> toParamName( $field ) . '">' . ucfirst($this -> fieldNames[$field]) . '</label>';
      $html .= '<input name="' . $this -> toParamName( $field ) . '" type="text" size="40" ';
      if( array_key_exists( $field, $criteria ) ) {
        $html .= 'value="' . $criteria[ $field ] . '" /><br />';
      } else {
        $html .= 'value="" /><br />';
      }
    }
    $html .= '<input type="submit" value="Search" />';
    $html .= '</form>';
    $html .= '<form class="bibwiki-search" action="" method="get">';
    $html .= '<input type="submit" value="Reset" />';
    $html .= '</form>';
    return $html;
  }

  function getDestroyForm( $obj ) {
    $html = '<form class="bibwiki-form" action="" method="post">';
    $html .= '<input name="' . $this -> toParamName( $this -> idField ) . '" type="hidden" value="' .
      $obj[ $this -> idField ] . '"></input>';
    $html .= '<input type="submit" value="Delete" />';
    $html .= '</form>';
    return $html;
  }

  function getEditHtml( $obj, $type ) {
    $html = '';
    $html .= '<form action="" method="post">';
    $html .= $this -> entryTypeNames[$type];
    if( array_key_exists( self::ID, $obj ) ) {
      $html .= '<input name="' . $this -> toParamName( self::ID ) . '" type="hidden" value="' . $obj[self::ID] . '" />' ;
    }
    $html .= '<input name="' . $this -> toParamName( self::TYPE ) . '" type="hidden" value="' . $type . '" />' ;
    foreach( array( 'required', 'optional' ) as $fieldRequirement ) {
      $html .= '<fieldset><legend>' . ucfirst( $fieldRequirement ) . '</legend>';

      foreach( $this -> entryTypeFields[ $type ][ $fieldRequirement ] as $field ) {
        $html .= '<label for="' . $this -> toParamName( $field  ) . '">' .
          ucfirst( $this -> fieldNames[$field] ) . '</label><br />' ;
        $html .= '<small>' . $this -> fieldDescs[$field] . '</small><br />';
        $value = '';
        if( array_key_exists( $field, $obj ) ) {
          $value = $obj[ $field ];
        }
        switch( $this -> fieldOptions[$field]['type'] ) {
          case 'string':
            $html .= '<input name="' . $this -> toParamName( $field ) . '" type="text" value="' . $value .
              '" size="' . $this -> fieldOptions[$field]['size'] . '"></input><br /><br />' ;
            break;
          case 'text':
            $html .= '<textarea name="' . $this -> toParamName( $field ) . '" cols="' . $this -> fieldOptions[$field]['cols'] .
              '"' . ' rows="' . $this -> fieldOptions[$field]['rows'] . '">' . $value . '</textarea><br /><br />' ;
            break;
        }
      }
      $html .= '</fieldset>';
    }
    $html .= '<input type="submit" value="Save" />' ;
    $html .= '</form>' ;
    return $html;
  }

  function getModifyHtml( $obj ) {
    return $this -> getEditHtml( $obj, $obj[ self::TYPE ] );
  }

  function getNewHtml( $obj, $type ) {
    return $this -> getEditHtml( $obj, $type );
  }

  function parseParams( $request ) {
    $obj = array();
    $obj[ self::TYPE ] = $request -> getVal( $this -> toParamName( self::TYPE ) );
    $obj[ self::ID ] = $request -> getVal( $this -> toParamName( self::ID ) );

    foreach( $this -> fields as $field ) {
      $value = $request -> getVal( $this -> toParamName( $field ) );
      if( $value != '' ) {
        $obj[$field] = $value;
      }
    }
    return $obj;
  }

  protected function genTitleHash( $title ) {
    preg_match_all( '/(\w)\w+/', $title, $matches );
    return strtoupper( join( $matches[1], '' ) );
  }

  protected function genTypeHash( $type ) {
    return ucfirst( strtolower( $type ) );
  }

  protected function genYearHash( $year ) {
    $prefix = '';
    for( $i = 1; $i <= 4-strlen( $year ); $i++ ) {
      $prefix .= 'x';
    }
    return $prefix . $year;
  }

  protected function genAuthorHash( $author ) {
    $test = preg_replace( '/ and.*$/', '', $author );

    $name = NULL;
    preg_match( '/(\w+)}/U', $test, $matches );
    if( count($matches) > 0 ) {
      $name = $matches[1];
    }
    if( $name == NULL ) {
      preg_match( '/(\w+),/U', $test, $matches );
      if( count($matches) > 0 ) {
        $name = $matches[1];
      }
      if( $name == NULL ) {
        preg_match( '/(\w+)$/', $test, $matches );
        if( count($matches) > 0 ) {
          $name = $matches[1];
        }
      }
    }
    return ucfirst( strtolower( $name ) );
  }

  protected function nvl( $array, $key, $replace ) {
    if( in_array( $key, array_keys( $array ) ) ) return $array[ $key ]; else return $replace;
  }

  protected function genID( $obj ) {
    return $this -> genAuthorHash( $obj[self::AUTHOR] ). '-' . $this -> genYearHash( $obj[self::YEAR] ). '-' .
      $this -> genTypeHash( $obj[self::TYPE] ) . '-' . $this -> genTitleHash( $obj[self::TITLE] );
  }

  protected function genTemplate( $obj ) {
    $result = '{{' . self::TEMPLATE_NAME;

    $result .= '|' . self::TYPE . '=' . $obj[self::TYPE];
    $result .= '|' . self::ID . '=' . $obj[self::ID];
    foreach( $this -> fields as $field ) {
      if( array_key_exists( $field, $obj ) ) {
        $result .= '|' . $field . '=' . $obj[$field];
      } else {
        $result .= '|' . $field . '=';
      }
    }
    $result .= '}}';
    return $result;
  }

  protected function genTitle( $obj ) {
    return $obj[self::ID];
  }

  function savePublication( $obj ) {
    $title = $this -> genTitle( $obj );
    $text = $this -> genTemplate( $obj );
    $this -> savePage( $title, $text );
  }

  function publicationExists( $id ) {
    $titleObject = Title::newFromText( $id );
    return $titleObject -> exists();
  }
  function publicationFileExists( $id ) {
    $titleObject = Title::newFromText( 'File:' . $id  . '.pdf' );
    return $titleObject -> exists();
  }

  function changePublicationID( $oldID, $newID ) {
    $oldTitle = $oldID;
    $newTitle = $newID;
    $this -> movePage( $oldTitle, $newTitle );
  }

  function changePublicationFileID( $oldID, $newID ) {
    $oldTitle = 'File:' . $oldID . '.pdf';
    $newTitle = 'File:'. $newID . '.pdf';
    if( $this -> publicationFileExists( $oldID ) ) {
      $this -> movePage( $oldTitle, $newTitle );
    }
  }

  function fetchPublication( $id ) {
    global $wgRequest;
    $api = new ApiMain( new DerivativeRequest( $wgRequest,
        array(
          'action' => 'query',
          'titles' =>  $id,
          'prop' => 'revisions',
          'rvprop' => 'content',
          'format' => 'xml'),
        false) );
    $api -> execute();
    $data = $api -> getResultData(); 
    $page = array_shift($data['query']['pages']);
    $rev = array_shift( $page['revisions'] );
    $result = $rev['*'];
    $obj = array();
    preg_match_all( '/(\w+)=(.*)[|}]/U', $result, $matches );
    foreach( $matches[1] as $index => $field ) {
      $value = $matches[2][$index];
      $obj[$field] = $value;
    }
    return $obj;
  }
  
  function savePage( $title, $text ) {
    global $wgRequest, $wgUser;

    $token = $wgUser -> editToken();
    $api = new ApiMain( new DerivativeRequest( $wgRequest,
        array(
          'action' => 'edit',
          'title' =>  $title,
          'text' => $text,
          'token' => $token),
        true),
        true );
    $api -> execute();
  }

  function movePage( $from, $to ) {
    global $wgRequest, $wgUser;

    $token = $wgUser -> editToken();
    $api = new ApiMain( new DerivativeRequest( $wgRequest,
        array(
          'action' => 'move',
          'from' =>  $from,
          'to' => $to,
          'token' => $token),
        true),
        true );
    $api -> execute();
  }

}
?>
