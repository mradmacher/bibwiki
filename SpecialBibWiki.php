<?php class SpecialBibWiki extends SpecialPage {
  protected $indexURL = '/wiki/Special:BibWikiIndex';
  protected $showURL = '/wiki/Special:BibWikiShow';
  protected $modifyURL = '/wiki/Special:BibWikiModify';
  protected $newURL = '/wiki/Special:BibWikiNew';
  protected $deleteURL = '/wiki/Special:BibWikiDelete';
  protected $importURL = '/wiki/Special:BibWikiImport';

  protected $idField = '_id';
  protected $paramPrefix = 'pub_';
  protected $typeField = 'entry_type';
  protected $bibkeyField = 'bibkey';

  protected $bibFields = array( 'address', 'annote', 'author', 'booktitle', 'chapter', 'crossref',
      'edition', 'editor', 'eprint', 'howpublished', 'institution', 'journal', 'key',
      'month', 'note', 'number', 'organization', 'pages', 'publisher', 'school', 'series',
      'title', 'type', 'url', 'volume', 'year' );

  protected $bibFieldNames = array(
      'address' => 'address',
      'annote' => 'annotation',
      'author' => 'author',
      'booktitle' => 'book title',
      'chapter' => 'chapter',
      'crossref' => 'cross-referenced key',
      'edition' => 'edition',
      'editor' => 'editor',
      'eprint' => 'eprint',
      'howpublished' => 'how published',
      'institution' => 'institution',
      'journal' => 'journal',
      'key' => 'key',
      'month' => 'month',
      'note' => 'note',
      'number' => 'number',
      'organization' => 'organization',
      'pages' => 'pages',
      'publisher' => 'publisher',
      'school' => 'school',
      'series' => 'series',
      'title' => 'title',
      'type' => 'field',
      'url' => 'url',
      'volume' => 'volume',
      'year' => 'year' );

  protected $bibFieldDescs = array(
    'address' => 'Publisher\'s address (usually just the city, but can be the full address for lesser-known publishers)',
    'annote' => 'An annotation for annotated bibliography styles (not typical)',
    'author' => 'The name(s) of the author(s) (in the case of more than one author, separated by and)',
    'booktitle' => 'The title of the book, if only part of it is being cited',
    'chapter' => 'The chapter number',
    'crossref' => 'The key of the cross-referenced entry',
    'edition' => 'The edition of a book, long form (such as "first" or "second")',
    'editor' => 'The name(s) of the editor(s)',
    'eprint' => 'A specification of an electronic publication, often a preprint or a technical report',
    'howpublished' => 'How it was published, if the publishing method is nonstandard',
    'institution' => 'The institution that was involved in the publishing, but not necessarily the publisher',
    'journal' => 'The journal or magazine the work was published in',
    'key' => 'A hidden field used for specifying or overriding the alphabetical order of entries (when the "author" and "editor" fields are missing). Note that this is very different from the key (mentioned just after this list) that is used to cite or cross-reference the entry.',
    'month' => 'The month of publication (or, if unpublished, the month of creation)',
    'note' => 'Miscellaneous extra information',
    'number' => 'The "(issue) number" of a journal, magazine, or tech-report, if applicable. (Most publications have a "volume", but no "number" field.)',
    'organization' => 'The conference sponsor',
    'pages' => 'Page numbers, separated either by commas or double-hyphens',
    'publisher' => 'The publisher\'s name',
    'school' => 'The school where the thesis was written',
    'series' => 'The series of books the book was published in (e.g. "The Hardy Boys" or "Lecture Notes in Computer Science")',
    'title' => 'The title of the work',
    'type' => 'The field overriding the default type of publication (e.g. "Research Note" for techreport, "{PhD} dissertation" for phdthesis, "Section" for inbook/incollection)',
    'url' => 'The WWW address',
    'volume' => 'The volume of a journal or multi-volume book',
    'year' => 'The year of publication (or, if unpublished, the year of creation)');

  protected $bibEntryTypes = array( 'article', 'book', 'booklet', 'inbook', 'incollection', 'inproceedings',
    'manual', 'mastersthesis', 'misc', 'phdthesis', 'proceedings', 'techreport', 'unpublished', 'conference' );

  protected $bibEntryTypeDescs = array(
    'article' => 'An article from a journal or magazine.', 
    'book' => 'A book with an explicit publisher.',
    'booklet' => 'A work that is printed and bound, but without a named publisher or sponsoring institution.',
    'conference' => 'The same as inproceedings, included for Scribe compatibility.',
    'inbook' => 'A part of a book, usually untitled. May be a chapter (or section or whatever) and/or a range of pages.',
    'incollection' => 'A part of a book having its own title.',
    'inproceedings' => 'An article in a conference proceedings.',
    'manual' => 'Technical documentation.',
    'mastersthesis' => 'A Master\'s thesis.',
    'misc' => 'For use when nothing else fits.',
    'phdthesis' => 'A Ph.D. thesis.',
    'proceedings' => 'The proceedings of a conference.',
    'techreport' => 'A report published by a school or other institution, usually numbered within a series.',
    'unpublished' => 'A document having an author and title, but not formally published.' );

  protected $bibEntryTypeFields = array(
    'article' => array( 
        'required' => array( 'author', 'title', 'journal', 'year' ),
        'optional' => array( 'volume', 'number', 'pages', 'month', 'note', 'key' ) 
        ),
    'book' => array( 
        'required' => array( /*'author/editor'*/ 'author', 'editor', 'title', 'publisher', 'year' ),
        'optional' => array( /*'volume/number'*/ 'volume', 'number', 'series', 'address', 'edition', 'month', 'note', 'key' ) 
        ),
    'booklet' => array( 
        'required' => array( 'title' ),
        'optional' => array( 'author', 'howpublished', 'address', 'month', 'year', 'note', 'key' ) 
        ),
    'inbook' => array( 
        'required' => array( /*'author/editor'*/ 'author', 'editor', 'title', 'chapter/pages', 'publisher', 'year' ),
        'optional' => array( /*'volume/number'*/'volume', 'number', 'series', 'type', 'address', 'edition', 'month', 'note', 'key' ) 
        ),
    'incollection' => array( 
        'required' => array( 'author', 'title', 'booktitle', 'publisher', 'year' ),
        'optional' => array( 'editor', /*'volume/number'*/'volume', 'number', 'series', 'type', 'chapter', 'pages', 'address', 'edition', 'month', 'note', 'key' )
        ),
    'inproceedings' => array( 
        'required' => array( 'author', 'title', 'booktitle', 'year' ),
        'optional' => array( 'editor', /*'volume/number'*/'volume', 'number', 'series', 'pages', 'address', 'month', 'organization', 'publisher', 'note', 'key' ) 
        ),
    'manual' => array(
        'required' => array( 'title' ),
        'optional' => array( 'author', 'organization', 'address', 'edition', 'month', 'year', 'note', 'key' )
        ),
    'mastersthesis' => array(
        'required' => array( 'author', 'title', 'school', 'year' ),
        'optional' => array( 'type', 'address', 'month', 'note', 'key' ),
        ),
    'misc' => array(
        'required' => array(),
        'optional' => array( 'author', 'title', 'howpublished', 'month', 'year', 'note', 'key' )
        ),
    'phdthesis' => array(
        'required' => array( 'author', 'title', 'school', 'year' ),
        'optional' => array( 'type', 'address', 'month', 'note', 'key' )
        ),
    'proceedings' => array(
        'required' => array( 'title', 'year' ),
        'optional' => array( 'editor', /*'volume/number'*/'volume', 'number', 'series', 'address', 'month', 'publisher', 'organization', 'note', 'key' )
        ),
    'techreport' => array(
        'required' => array( 'author', 'title', 'institution', 'year' ),
        'optional' => array( 'type', 'number', 'address', 'month', 'note', 'key' )
        ),
    'unpublished' => array(
        'required' => array( 'author', 'title', 'note' ),
        'optional' => array( 'month', 'year', 'key' )
        ),
    'conference' => array(
        'required' => array( 'author', 'title', 'booktitle', 'year' ),
        'optional' => array( 'editor', /*'volume/number'*/'volume', 'number', 'series', 'pages', 'address', 'month', 'organization', 'publisher', 'note', 'key' ) 
        )
    );

  protected $searcheableFields = array( 'author', 'title', 'publisher', 'journal', 'year' );

  function __construct( $name ) {
    parent::__construct( $name );
  }


  protected function getConnection() {
    global $wgBibWikiDBName;
    if( $this -> dbConnection == NULL ) {
      $this -> dbConnection = new Mongo();
    }
    return $this -> dbConnection -> selectDB( $wgBibWikiDBName );
  }

  protected function findById( $id ) {
    $obj = $this -> getConnection() -> publications -> findOne( array(  $this -> idField  => new MongoId( $id ) ) );
    return $obj;
  }

  protected function removeById( $id ) {
    $this -> getConnection() -> publications -> remove( array( $this -> idField => new MongoId( $id ) )  ); 
  }

  protected function find( $criteria ) {
    $conditions = array();
    foreach( $criteria as $key => $value ) {
      if( $value != '' ) {
        $conditions[$key] = new MongoRegex( '/' . $value . '/i' );
      }
    }
    return $this -> getConnection() -> publications -> find( $conditions );
  }

  protected function isUnique( $bibkey, $excludeid = NULL ) {
    if( $excludeid == NULL ) {
      return sizeof( $this -> getConnection() -> publications -> findOne( array( $this -> bibkeyField => $bibkey ) ) ) == 0;
    } else {
      return sizeof( $this -> getConnection() -> publications -> findOne(
        array( $this -> bibkeyField => $bibkey, $this -> idField => array( '$ne' => new MongoId( $excludeid ) ) ) ) ) == 0;
    }
  }

  protected function save( $obj ) {
    $id = $obj[ $this -> idField ];
    if( $id != '' ) {
      $obj[ $this -> idField ] = new MongoId( $id );
    } else {
      unset( $obj[ $this -> idField ] );
    }
    $this -> getConnection() -> publications -> save( $obj );
  }

  protected function import( $collection ) {
    if( count($collection) > 0 ) {
      $this -> getConnection() -> publications -> batchInsert( $collection );
    }
  }
  protected function toParamName( $key ) {
    return $this -> paramPrefix . $key;
  }

  protected function linkTo( $title, $url, $params = array() ) {
    $parary = array();
    $parurl = $url;
    foreach( $params as $key => $value ) {
      array_push( $parary, $this -> paramPrefix . $key . '=' . $value );
    }
    if( count( $parary ) > 0 ) {
      $parurl .= '?' . join( $parary, '&' );
    }
    return '<a class="bibwiki-link" href="' . $parurl . '">' . $title . '</a>';
  }
  protected function linkToId( $title, $url, $id ) {
    return $this -> linkTo( $title, $url, array( $this -> idField => $id ) );
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
    $wgOut -> addInlineStyle( $this -> getCSS() );
  }

  function getSearchForm( $criteria ) {
    $html = '<br />';
    $html .= '<form class="bibwiki-search" action="' . $this -> indexURL . '" method="get">';
    foreach( $this -> searcheableFields as $field ) {
      $html .= '<label for="' . $this -> toParamName( $field ) . '">' . ucfirst($this -> bibFieldNames[$field]) . '</label>';
      $html .= '<input name="' . $this -> toParamName( $field ) . '" type="text" size="40" ';
      $html .= 'value="' . $criteria[ $field ] . '" /><br />';
    }
    $html .= '<input type="submit" value="Search" />';
    $html .= '</form>';
    $html .= '<form class="bibwiki-search" action="' . $this -> indexURL . '" method="get">';
    $html .= '<input type="submit" value="Reset" />';
    $html .= '</form>';
    return $html;
  }

  function getDestroyForm( $obj ) {
    $html = '<form class="bibwiki-form" action="' . $this -> deleteURL . '" method="post">';
    $html .= '<input name="pub_id" type="hidden" value="' . $obj[ $this -> idField ] . '"></input>';
    $html .= '<input type="submit" value="Delete" />';
    $html .= '</form>';
    return $html;
  }

  function getShowHtml( $obj ) {
    $html = '';
    $html .= '<br />';
    $html .= '<b>' . ucfirst( $obj[ $this -> typeField ] ) . '</b>';
    $html .= '<br />';
    $html .= '<small>' . $obj[ $this -> bibkeyField ] . '</small>';
    $html .= '<dl>';
    $type = $obj[ $this -> typeField ];
    //$html .= '<dt>Entry type</td><dd>' . $obj[ $this -> typeField ] . '</dd>';
    //$html .= '<dt>Bibkey</td><dd>' . $obj[ $this -> bibkeyField ] . '</dd>';
    foreach( array( 'required', 'optional' ) as $fieldRequirement ) {
      foreach( $this -> bibEntryTypeFields[ $type ][ $fieldRequirement ] as $bibField ) {
        $value = $obj[ $bibField ];
        if( $value != '' ) {
          $html .= '<dt>' . ucfirst( $this -> bibFieldNames[ $bibField ] ) . '</dt><dd>' . $value . '</dd>';
        }
      }
    }
    return $html;
  }

  function getEditHtml( $obj, $type ) {
    $html = '';
    $html .= '<form action="" method="post">';
    $html .= '<input name="pub_id" type="hidden" value="' . $obj[ $this -> idField ] . '" />' ;
    $html .= '<input name="pub_entry_type" type="text" readonly="readonly" value="' . $type . '" />' ;
    foreach( array( 'required', 'optional' ) as $fieldRequirement ) {
      $html .= '<fieldset><legend>' . ucfirst( $fieldRequirement ) . '</legend>';

      foreach( $this -> bibEntryTypeFields[ $type ][ $fieldRequirement ] as $bibField ) {
        $html .= '<label for="pub_' . $bibField . '">' . ucfirst( $this -> bibFieldNames[ $bibField ] ) . '</label><br />' ;
        $html .= '<small>' . $this -> bibFieldDescs[ $bibField ] . '</small><br />';
        $html .= '<input name="pub_' . $bibField . '" type="text" value="' . $obj[ $bibField ] . '" size="70"></input><br /><br />' ;
      }
      $html .= '</fieldset>';
    }
    $html .= '<input type="submit" value="Save" />' ;
    $html .= '</form>' ;
    return $html;
  }

  function getModifyHtml( $obj ) {
    return $this -> getEditHtml( $obj, str_replace( '@', '', $obj[ $this -> typeField ] ) );
  }

  function getNewHtml( $obj, $type ) {
    return $this -> getEditHtml( $obj, $type );
  }

  function getIndexHtml( $collection ) {
    $html = '<table class="bibwiki-table">';
    $html .= '<tr>';
    $html .= '<th>' . ucfirst( $this -> bibFieldNames[ 'year' ] ) . '</th>';
    $html .= '<th>' . ucfirst( $this -> bibFieldNames[ 'title' ] ) . '</th>';
    $html .= '<th>' . ucfirst( $this -> bibFieldNames[ 'author' ] ) . '</th>';
    $html .= '<th>' . ucfirst( $this -> bibFieldNames[ 'publisher' ] ) . '</th>';
    $html .= '<th>' . ucfirst( $this -> bibFieldNames[ 'journal' ] ) . '</th>';
    $html .= '</tr>';
    foreach( $collection as $obj ) {
      $html .= '<tr>';
      $html .= '<td>' . $obj['year'] . '</td>';
      $html .= '<td>' . $obj['title'] . '</td>';
      $html .= '<td>' . $obj['author'] . '</td>';
      $html .= '<td>' . $obj['publisher'] . '</td>';
      $html .= '<td>' . $obj['journal'] . '</td>';
      $html .= '</tr>';
      $html .= '<tr><td colspan="3">' . $this -> linkToId( 'Show', $this -> showURL, $obj[ $this -> idField ] ) .
        $this -> linkToId( 'Modify', $this -> modifyURL, $obj[ $this -> idField ] ) .
        $this -> linkToId( 'Delete', $this -> deleteURL, $obj[ $this -> idField ] ) . '</td></tr>';
    }
    $html .= '</table>';
    return $html;
  }

  function parseFields( $request ) {
    $obj = array();
    $obj[ $this -> typeField ] = $request -> getVal( $this -> toParamName( $this -> typeField ) );
    $obj[ $this -> idField ] = $request -> getVal( $this -> toParamName( $this -> idField ) );

    foreach( $this -> bibFields as $field ) {
      $value = $request -> getVal( $this -> toParamName( $field ) );
      if( $value != '' ) {
        $obj[$field] = $value;
      }
    }
    return $obj;
  }

  protected function genTitleHash( $title ) {
    preg_match_all( '/(\w)\w+/', $title, $matches );
    return strtolower( join( $matches[1], '' ) );
  }

  protected function genYearHash( $year ) {
    $prefix = '';
    for( $i = 1; $i <= 4-strlen( $year ); $i++ ) {
      $prefix .= '.';
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
    return strtolower( $name );
  }

  protected function genBibkey( $obj ) {
    return $this -> genAuthorHash( $obj[ 'author' ] ) . $this -> genYearHash( $obj[ 'year' ] ) . $this -> genTitleHash( $obj[ 'title' ] );
  }
  
}
?>
