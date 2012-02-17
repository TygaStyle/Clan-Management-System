<?php
if (function_exists("FeedForAll_scripts_getRFDdate") === FALSE) {
  Function FeedForAll_scripts_getRFDdate($datestring) {
    $startTZ = 19;
    
    $year = substr($datestring, 0, 4);
    $month = substr($datestring, 5, 2);
    $day = substr($datestring, 8, 2);
    $hour = substr($datestring, 11, 2);
    $minute = substr($datestring, 14, 2);
    $second = substr($datestring, 17, 2);
    if ($datestring[$startTZ] == ".") {
      $curChar = $datestring[$startTZ];
      while (($startTZ < strlen($datestring)) && ($curChar != "Z") && ($curChar != "+") && ($curChar != "-")) {
        $startTZ++;
        $curChar = $datestring[$startTZ];
      }
    }
    if ($datestring[$startTZ] == "Z") {
      $offset_hour = 0;
      $offset_minute = 0;
    } else {
      if (substr($datestring, $startTZ, 1) == "-") {
        $offset_hour = substr($datestring, $startTZ+1, 2);
        $offset_minute = substr($datestring, $startTZ+4, 2);
      } else {
        $offset_hour = -1*substr($datestring, $startTZ+1, 2);
        $offset_minute = -1*substr($datestring, $startTZ+4, 2);
      }
    }
    return gmmktime($hour+$offset_hour, $minute+$offset_minute, $second, $month, $day, $year);
  }
}

if (function_exists("FeedForAll_scripts_convertEncoding") === FALSE) {
  Function FeedForAll_scripts_convertEncoding($XMLstring, $missingEncodingDefault="ISO-8859-1", $destinationEncoding="UTF-8") {
    $results = NULL;
    $inputEncoding = $missingEncodingDefault;
    $workString = $XMLstring;

    if (function_exists("mb_convert_encoding") !== FALSE) {

      if (preg_match("/<\?xml(.*)\?>/", $XMLstring, $results) === FALSE) return FALSE;

      if (count($results) == 0) return FALSE;

      $initialXMLHeader = $results[0];
      $results[0] = str_replace("'", "\"", str_replace(" ", "", $results[0]));

      if (($location = stristr($results[0], "encoding=")) !== FALSE) {
        $parts = split("\"", $location);

        if (strcasecmp($parts[1], $destinationEncoding) == 0) {
          return $XMLstring;
        }
        $inputEncoding = $parts[1];
        $modifiedXMLHeader = str_replace($inputEncoding, $destinationEncoding, $initialXMLHeader);
      } else {
        $modifiedXMLHeader = str_replace("?>", " encoding=\"$destinationEncoding\" ?>", $initialXMLHeader);
      }
      $workString = str_replace($initialXMLHeader, $modifiedXMLHeader, $workString);

      if (($newResult = mb_convert_encoding($workString, $destinationEncoding, $inputEncoding)) !== FALSE) {
        return $newResult;
      }
    }
    if (function_exists("iconv") !== FALSE) {

      if (preg_match("/<\?xml(.*)\?>/", $XMLstring, $results) === FALSE) return FALSE;

      if (count($results) == 0) return FALSE;

      $initialXMLHeader = $results[0];
      $results = str_replace(" ", "", $results);
      $results = str_replace("'", "\"", $results);

      if (($location = stristr($results[0], "encoding=")) !== FALSE) {
        $parts = split("\"", $location);

        if (strcasecmp($parts[1], $destinationEncoding) == 0) {
          return $XMLstring;
        }
        $inputEncoding = $parts[1];
        $modifiedXMLHeader = str_replace($inputEncoding, $destinationEncoding, $initialXMLHeader);
      } else {
        $modifiedXMLHeader = str_replace("?>", " encoding=\"$destinationEncoding\" ?>", $initialXMLHeader);
      }
      $workString = str_replace($initialXMLHeader, $modifiedXMLHeader, $workString);

      if (($newResult = iconv($inputEncoding, "$destinationEncoding//TRANSLIT", $workString)) !== FALSE) {
        return $newResult;
      }
    }
    return FALSE;
  }
}

if (function_exists("FeedForAll_scripts_readFile") === FALSE) {
  Function FeedForAll_scripts_readFile($filename, $useFopenURL, $useCaching = 0) {
    GLOBAL $connectTimeoutLimit;

    if ($useCaching);

    $GLOBALS["ERRORSTRING"] = "";
    $result = "";
    if (stristr($filename, "://")) {
      if ($useFopenURL) {
        if (($fd = @fopen($filename, "rb")) === FALSE) {
          return FALSE;
        }
        while (($data = fread($fd, 4096)) != "") {
          $result .= $data;
        }
        fclose($fd);
      } else {
        // This is a URL so use CURL
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $filename);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_USERAGENT, "FeedForAll rssFilter.php v2");
        //    curl_setopt($curlHandle, CURLOPT_AUTOREFERER, 1);
        curl_setopt($curlHandle, CURLOPT_REFERER, $filename);
        if (!(ini_get("safe_mode") || ini_get("open_basedir"))) {
          curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, 1);
        }
        if (isset($connectTimeoutLimit) && $connectTimeoutLimit != 0) {
          curl_setopt($curlHandle, CURLOPT_CONNECTTIMEOUT, $connectTimeoutLimit);
        }
        curl_setopt($curlHandle, CURLOPT_MAXREDIRS, 10);
        $result = curl_exec($curlHandle);
        if (curl_errno($curlHandle)) {
          $GLOBALS["ERRORSTRING"] = curl_error($curlHandle);
          curl_close($curlHandle);
          return FALSE;
        }
        curl_close($curlHandle);
      }
    } else {
      // This is a local file, so use fopen
      if (($fd = @fopen($filename, "rb")) === FALSE) {
        return FALSE;
      }
      while (($data = fread($fd, 4096)) != "") {
        $result .= $data;
      }
      fclose($fd);
    }
    return $result;
  }
}

class rootItemClass {
  var $operateAs;
  var $title;
  var $description;
  var $contentEncoded;
  var $link;
  var $pubDate;
  var $pubDate_t;
  var $pubDateDC;
  var $enclosureURL;
  var $enclosureLength;
  var $enclosureType;
  var $categoryArray;
  var $category;
  var $categoryDomain;
  var $guid;
  var $guidIsPermaLink;
  var $author;
  var $comments;
  var $source;
  var $sourceURL;
  var $creativeCommons;
  var $rssMeshExtra;
  var $rssMeshFeedImageTitle;
  var $rssMeshFeedImageUrl;
  var $rssMeshFeedImageLink;
  var $rssMeshFeedImageDescription;
  var $rssMeshFeedImageHeight;
  var $rssMeshFeedImageWidth;
  var $atomID;
  var $atomUpdated;
  var $atomContent;
  var $atomContentStartPos;
  var $atomAuthorEmail;
  
  var $contentEncodedUsed;

  var $itemStartPos;
  var $itemFullText;

  // Constructor
  Function rootItemClass($operateAs) {
    $this->operateAs = $operateAs;
    $this->title = "";
    $this->description = "";
    $this->contentEncoded = "";
    $this->link = "";
    $this->pubDate = "";
    $this->pubDate_t = 0;
    $this->pubDateDC = "";
    $this->enclosureURL = "";
    $this->enclosureLength = "";
    $this->enclosureType = "";
    $this->categoryArray = Array();
    $this->category = "";
    $this->categoryDomain = "";
    $this->guid = "";
    $this->guidIsPermaLink = "";
    $this->author = "";
    $this->comments = "";
    $this->source = "";
    $this->sourceURL = "";
    $this->creativeCommons = "";
    $this->rssMeshExtra = "";
    $this->rssMeshFeedImageTitle = "";
    $this->rssMeshFeedImageUrl = "";
    $this->rssMeshFeedImageLink = "";
    $this->rssMeshFeedImageDescription = "";
    $this->rssMeshFeedImageHeight = "";
    $this->rssMeshFeedImageWidth = "";
    $this->atomID = "";
    $this->atomUpdated = "";
    $this->atomContent = "";
    $this->atomContentStartPos = 0;
    $this->atomAuthorEmail = "";
    
    $this->contentEncodedUsed = 0;

    $this->itemStartPos = 0;
    $this->itemFullText = "";
  }

  Function getValueOf($elementName) {
    if ($elementName == "~~~ItemTitle~~~") {
      return $this->title;
    }
    elseif ($elementName == "~~~ItemDescription~~~") {
      return $this->description;
    }
    elseif ($elementName == "~~~ItemContentEncoded~~~") {
      return $this->contentEncoded;
    }
    elseif ($elementName == "~~~ItemLink~~~") {
      return $this->link;
    }
    elseif ($elementName == "~~~ItemPubDate~~~") {
      return $this->pubDate;
    }
    elseif ($elementName == "~~~ItemPubDateAsNumber~~~") {
      return $this->pubDate_t;
    }
    elseif ($elementName == "~~~ItemEnclosureUrl~~~") {
      return $this->enclosureURL;
    }
    elseif ($elementName == "~~~ItemEnclosureType~~~") {
      return $this->enclosureType;
    }
    elseif ($elementName == "~~~ItemEnclosureLength~~~") {
      return $this->enclosureLength;
    }
    elseif ($elementName == "~~~ItemGuid~~~") {
      return $this->guid;
    }
    elseif ($elementName == "~~~ItemAuthor~~~") {
      return $this->author;
    }
    elseif ($elementName == "~~~ItemComments~~~") {
      return $this->comments;
    }
    elseif ($elementName == "~~~ItemSource~~~") {
      return $this->source;
    }
    elseif ($elementName == "~~~ItemSourceUrl~~~") {
      return $this->sourceURL;
    }
    elseif ($elementName == "~~~ItemCategory~~~") {
      if (count($this->categoryArray)) {
        return $this->categoryArray[0]["Category"];
      }
    }
    elseif ($elementName == "~~~ItemCategoryDomain~~~") {
      if (count($this->categoryArray)) {
        return $this->categoryArray[0]["Domain"];
      }
    }
    elseif ($elementName == "~~~ItemCreativeCommons~~~") {
      return $this->creativeCommons;
    }
    elseif ($elementName == "~~~ItemRssMeshExtra~~~") {
      return $this->rssMeshExtra;
    }
    elseif ($elementName == "~~~ItemRssMeshFeedImageTitle~~~") {
      return $this->rssMeshFeedImageTitle;
    }
    elseif ($elementName == "~~~ItemRssMeshFeedImageUrl~~~") {
      return $this->rssMeshFeedImageUrl;
    }
    elseif ($elementName == "~~~ItemRssMeshFeedImageLink~~~") {
      return $this->rssMeshFeedImageLink;
    }
    elseif ($elementName == "~~~ItemRssMeshFeedImageDescription~~~") {
      return $this->rssMeshFeedImageDescription;
    }
    elseif ($elementName == "~~~ItemRssMeshFeedImageHeight~~~") {
      return $this->rssMeshFeedImageHeight;
    }
    elseif ($elementName == "~~~ItemRssMeshFeedImageWidth~~~") {
      return $this->rssMeshFeedImageWidth;
    }
    return NULL;
  }

  Function getArrayOfFields() {
    $result = Array();

    $result[] = "~~~ItemTitle~~~";
    $result[] = "~~~ItemDescription~~~";
    $result[] = "~~~ItemContentEncoded~~~";
    $result[] = "~~~ItemLink~~~";
    $result[] = "~~~ItemPubDate~~~";
    $result[] = "~~~ItemPubDateAsNumber~~~";
    $result[] = "~~~ItemEnclosureUrl~~~";
    $result[] = "~~~ItemEnclosureType~~~";
    $result[] = "~~~ItemEnclosureLength~~~";
    $result[] = "~~~ItemGuid~~~";
    $result[] = "~~~ItemAuthor~~~";
    $result[] = "~~~ItemComments~~~";
    $result[] = "~~~ItemSource~~~";
    $result[] = "~~~ItemSourceUrl~~~";
    $result[] = "~~~ItemCategory~~~";
    $result[] = "~~~ItemCategoryDomain~~~";
    $result[] = "~~~ItemCreativeCommons~~~";
    $result[] = "~~~ItemRssMeshExtra~~~";
    $result[] = "~~~ItemRssMeshFeedImageTitle~~~";
    $result[] = "~~~ItemRssMeshFeedImageUrl~~~";
    $result[] = "~~~ItemRssMeshFeedImageLink~~~";
    $result[] = "~~~ItemRssMeshFeedImageDescription~~~";
    $result[] = "~~~ItemRssMeshFeedImageHeight~~~";
    $result[] = "~~~ItemRssMeshFeedImageWidth~~~";
    
    return $result;
  }
  
}

$startingClassName = "rootItemClass";
if (function_exists("rssFilter_extendClass")) {
  $startingClassName = rssFilter_extendClass($startingClassName);
}

if (function_exists("FeedForAll_parseExtensions_extendClass")) {
  $currentBaseClassName = FeedForAll_parseExtensions_extendClass($startingClassName);
} else {
  $currentBaseClassName = $startingClassName;
}
eval('class baseItemClassWithExtensions extends ' . $currentBaseClassName . ' {}');

class baseItemClass extends baseItemClassWithExtensions {
  Function baseItemClass($operateAs) {
    $parentClass = get_parent_class($this);
    $this->$parentClass($operateAs);
  }
}

class rootRSSParserClass {
  var $operateAs;
  var $gotROOT;
  var $feedTYPE;
  var $wholeString;
  var $level;
  var $tag;
  var $noFutureItems;
  
  var $currentItem;

  var $FeedTitle;
  var $FeedDescription;
  var $FeedContentEncoded;
  var $FeedLink;
  var $FeedPubDate;
  var $FeedPubDateDC;
  var $FeedPubDate_t;
  var $FeedLastBuildDate;
  var $FeedImageURL;
  var $FeedImageTitle;
  var $FeedImageLink;
  var $FeedImageDescription;
  var $FeedImageHeight;
  var $FeedImageWidth;
  var $FeedCreativeCommons;
  var $FeedAtomUpdated;
  var $FeedAtomContent;
  var $FeedAtomContentStartPos;
  var $FeedAtomAuthorEmail;
  
  var $contentEncodedUsed;

  var $Items;

  //
  var $insideChannel = FALSE;
  var $level_channel;
  var $insideChannelImage = FALSE;
  var $level_channelImage;
  var $insideItem = FALSE;
  var $level_item;
  var $insideAtomAuthor = FALSE;

  Function rootRSSParserClass($operateAs) {
    $this->operateAs = $operateAs;
    $this->gotROOT = 0;
    $this->feedTYPE = "RSS";
    $this->wholeString = "";
    $this->level = 0;
    $this->tag = "";
    $this->noFutureItems = 0;;
  
    $this->FeedImageURL = "";
    $this->FeedImageTitle = "";
    $this->FeedImageLink = "";
    $this->FeedImageDescription = "";
    $this->FeedImageHeight = "";
    $this->FeedImageWidth = "";
    $this->currentItem;

    $this->FeedTitle = "";
    $this->FeedDescription = "";
    $this->FeedContentEncoded = "";
    $this->FeedLink = "";
    $this->FeedPubDate = "";
    $this->FeedPubDateDC = "";
    $this->FeedPubDate_t = 0;
    $this->FeedLastBuildDate = "";
    $this->FeedImageURL = "";
    $this->FeedImageTitle = "";
    $this->FeedImageLink = "";
    $this->FeedImageDescription = "";
    $this->FeedImageHeight = "";
    $this->FeedImageWidth = "";
    $this->FeedCreativeCommons = "";
    $this->FeedAtomUpdated = "";
    $this->FeedAtomContent = "";
    $this->FeedAtomContentStartPos = 0;
    $this->FeedAtomAuthorEmail = "";

    $this->contentEncodedUsed = 0;
    
    $this->Items = Array();

    //
    $this->insideChannel = FALSE;
    $this->level_channel = 0;
    $this->insideChannelImage = FALSE;
    $this->level_channelImage = 0;
    $this->insideItem = FALSE;
    $this->level_item = 0;
  }

  function startElement($parser, $tagName, $attrs) {
    GLOBAL $debugLevel;
    
    $this->level++;
    $this->tag = $tagName;
    if ($this->gotROOT == 0) {
      $this->gotROOT = 1;
      if (strstr($tagName, "RSS")) {
        $this->feedTYPE = "RSS";
      }
      elseif (strstr($tagName, "RDF")) {
        $this->feedTYPE = "RDF";
      }
      elseif (strstr($tagName, "FEE")) {
        $this->feedTYPE = "FEE";
        $this->insideChannel = TRUE;
        $this->level_channel = 1;
      }
    }
    elseif ((($tagName == "ITEM") && ($this->feedTYPE != "FEE")) || (($tagName == "ENTRY") && ($this->feedTYPE == "FEE"))) {
      if (isset($debugLevel) && ($debugLevel >= 2)) {
        echo "DIAG: startElement(\$parser, $tagName, \$attrs)<br>\n";
      }
      
      $this->insideItem = TRUE;
      $this->level_item = $this->level;
      $this->currentItem = new baseItemClass($this->operateAs);

      //
      // Find the start of the <item> or <entry>
      $this->currentItem->ItemStartPos = xml_get_current_byte_index($parser);
      if ($this->wholeString[$this->currentItem->ItemStartPos] != "<") {
        $startToHere = substr($this->wholeString, 0, $this->currentItem->ItemStartPos);
        $this->currentItem->ItemStartPos = strrpos($startToHere, "<");
      }

    }
    elseif ($this->insideChannel && (($tagName == "AUTHOR") && ($this->feedTYPE == "FEE"))) {
      $this->insideAtomAuthor = TRUE;
    }
    elseif ($this->insideItem && (($tagName == "AUTHOR") && ($this->feedTYPE == "FEE"))) {
      $this->insideAtomAuthor = TRUE;
    }
    elseif (($this->insideItem) && ($tagName == "ENCLOSURE")) {
      if (isset($attrs["URL"])) {
        $this->currentItem->enclosureURL = $attrs["URL"];
      }
      if (isset($attrs["TYPE"])) {
        $this->currentItem->enclosureType = $attrs["TYPE"];
      }
      if (isset($attrs["LENGTH"])) {
        $this->currentItem->enclosureLength = $attrs["LENGTH"];
      }
    }
    elseif (($this->insideItem) && ($tagName == "SOURCE")) {
      if (isset($attrs["URL"])) {
        $this->currentItem->sourceURL = $attrs["URL"];
      }
    }
    elseif (($this->insideItem) && ($tagName == "CATEGORY")) {
      if (isset($attrs["DOMAIN"])) {
        $this->currentItem->categoryDomain = $attrs["DOMAIN"];
      }
    }
    elseif (($this->insideItem) && ($tagName == "GUID")) {
      if (isset($attrs["ISPERMALINK"])) {
        $this->currentItem->guidIsPermaLink = $attrs["ISPERMALINK"];
      }
    }
    elseif (($tagName == "LINK") && ($this->feedTYPE == "FEE")) {
      if ($this->insideItem) {
        if (isset($attrs["REL"]) && ($attrs["REL"] == "enclosure")) {
          $this->currentItem->enclosureURL = $attrs["HREF"];
          $this->currentItem->enclosureType = $attrs["TYPE"];
          $this->currentItem->enclosureLength = $attrs["LENGTH"];
        }
        elseif (isset($attrs["HREF"]) && ((isset($attrs["TYPE"]) && ($attrs["TYPE"] == "text/html")) || !isset($attrs["TYPE"]))) {
          $this->currentItem->link = $attrs["HREF"];
        }
      } else {
        if (isset($attrs["HREF"]) && ((isset($attrs["TYPE"]) && ($attrs["TYPE"] == "text/html")) || !isset($attrs["TYPE"]))) {
          $this->FeedLink = $attrs["HREF"];
        }
      }
    }
    elseif ($tagName == "CHANNEL") {
      $this->insideChannel = TRUE;
      $this->level_channel = $this->level;
    }
    elseif (($tagName == "IMAGE") && ($this->insideChannel == TRUE)) {
      $this->insideChannelImage = TRUE;
      $this->level_channelImage = $this->level;
    }
    elseif ($tagName == "CONTENT") {
      if ($this->insideItem == TRUE) {
        if (isset($attrs["TYPE"]) && ($attrs["TYPE"] == "xhtml")) {
          //
          // Find the start of the <content ... >
          $this->currentItem->atomContentStartPos = xml_get_current_byte_index($parser);
          if ($this->wholeString[$this->currentItem->atomContentStartPos] != "<") {
            $startToHere = substr($this->wholeString, 0, $this->currentItem->atomContentStartPos);
            $this->currentItem->atomContentStartPos = strrpos($startToHere, "<");
          }
        }
      } else {
        if (isset($attrs["TYPE"]) && ($attrs["TYPE"] == "xhtml")) {
          //
          // Find the start of the <content ... >
          $this->FeedAtomContentStartPos = xml_get_current_byte_index($parser);
          if ($this->wholeString[$this->FeedAtomContentStartPos] != "<") {
            $startToHere = substr($this->wholeString, 0, $this->FeedAtomContentStartPos);
            $this->FeedAtomContentStartPos = strrpos($startToHere, "<");
          }
        }
      }
    }
    if (FeedForAll_parseExtensions() === TRUE) {
      FeedForAll_parseExtensions_startElemend($parser, $this, $tagName, $attrs);
    }
  }

  function endElement($parser, $tagName) {
    GLOBAL $debugLevel;

    $this->tag = "";
    $this->level--;
    if (($this->insideItem) && ($tagName == "CATEGORY")) {
      $this->currentItem->categoryArray[] = Array("Category" => $this->currentItem->category, "Domain" => $this->currentItem->categoryDomain);
      $this->currentItem->category = "";
      $this->currentItem->categoryDomain = "";
    }
    elseif ((($tagName == "ITEM") && ($this->feedTYPE != "FEE")) || (($tagName == "ENTRY") && ($this->feedTYPE == "FEE"))) {
      if (isset($debugLevel) && ($debugLevel >= 2)) {
        echo "DIAG: endElement(\$parser, $tagName)<br>\n";
      }
      
      $this->UseItem = TRUE;

      //
      // Do any special processing to convert ATOM to RSS 2.0
      if ($this->feedTYPE == "FEE") {
        if ($this->currentItem->guid == "") {
          // There was no GUID, use ID
          $this->currentItem->guid = $this->currentItem->atomID;
          $this->currentItem->guidIsPermaLink = "false";
        }
      }
      
      //
      // The the whole item string
      $pos = xml_get_current_byte_index($parser) - 2;
      if ($this->wholeString[$pos] != ">") {
        $hereToEnd = substr($this->wholeString, $pos);
        $closePos = strpos($hereToEnd, ">");
      } else {
        $closePos = 0;
      }
      $this->currentItem->itemFullText = substr($this->wholeString, $this->currentItem->ItemStartPos, $pos + $closePos - $this->currentItem->ItemStartPos+1);

      //
      // Get the pubDate from pubDate first and then dc:date
      if (trim($this->currentItem->pubDate) != "") {
        $this->currentItem->pubDate = trim($this->currentItem->pubDate);
        $this->currentItem->pubDate_t = strtotime($this->currentItem->pubDate);
      }
      elseif (($this->feedTYPE == "FEE") && (trim($this->currentItem->atomUpdated) != "")) {
        $this->currentItem->atomUpdated = trim($this->currentItem->atomUpdated);
        $this->currentItem->pubDate_t = FeedForAll_scripts_getRFDdate($this->currentItem->atomUpdated);
        $this->currentItem->pubDate = date("D, d M Y H:i:s O", $this->currentItem->pubDate_t);
      }
      elseif (trim($this->currentItem->pubDateDC) != "") {
        $this->currentItem->pubDate_t = FeedForAll_scripts_getRFDdate($this->currentItem->pubDateDC);
        $this->currentItem->pubDate = date("D, d M Y H:i:s O", $this->currentItem->pubDate_t);
      } else {
        $this->currentItem->pubDate_t = time();
        $this->currentItem->pubDate = date("D, d M Y H:i:s O", $this->currentItem->pubDate_t);
      }

      if (($this->operateAs == "rssFilter") && function_exists("rssFilter_useItem")) {
        GLOBAL $_REQUEST;

        $this->UseItem = rssFilter_useItem($this->currentItem);

        if (isset($_REQUEST["testScript"])) {
          if ($this->UseItem) {
            echo "USING Item: ".htmlentities($this->currentItem->title)."<br>\n";
          } else {
            echo "NOT Using: ".htmlentities($this->currentItem->title)."<br>\n";
          }
        }
      }

      if ($this->operateAs == "rssMesh") {
        if (($this->itemLimit >= 0) && (count($this->Items) > $this->itemLimit)) {
          $this->UseItem = FALSE;
        }
      }
      elseif ($this->operateAs == "rss2html") {
        if (($useUniq = FeedForAll_rss2html_UseUniqueLink($this->currentItem->title, $this->currentItem->description, $this->currentItem->link, $this->currentItem->guid)) != -1) {
          if ($useUniq == 0) {
            if (isset($debugLevel) && ($debugLevel >= 2)) {
              echo "DIAG: FeedForAll_rss2html_UseUniqueLink() => 0, Not using<br>\n";
            }

            $this->UseItem = FALSE;
          }
        }
        if ($this->noFutureItems) {
          $noon = strtotime("today at 12:00");
          if (($this->currentItem->pubDate_t - $noon) > 43200) {
            if (isset($debugLevel) && ($debugLevel >= 2)) {
              echo "DIAG: future pubdate, Not using<br>\n";
            }
            $this->UseItem = FALSE;
          }
        }
      }

      if ($this->UseItem) {
        if (isset($debugLevel) && ($debugLevel >= 2)) {
          echo "DIAG: Using item \"".$this->currentItem->title."\"<br>\n";
        }
        
        //
        // Clean up some of the values
        $this->currentItem->title = trim($this->currentItem->title);
        $this->currentItem->description = trim($this->currentItem->description);
        if ($this->feedTYPE == "FEE") {
          $this->currentItem->atomContent = trim($this->currentItem->atomContent);
          $this->currentItem->description = $this->currentItem->atomContent;
        } else {
          $this->currentItem->description = $this->currentItem->description;
        }
        if (trim($this->currentItem->contentEncoded) == "") {
          if  ($this->operateAs != "rssMesh") {
            $this->currentItem->contentEncoded = $this->currentItem->description;
          }
        } else {
          $this->currentItem->contentEncoded = trim($this->currentItem->contentEncoded);
        }
        if (trim($this->currentItem->description) == "") {
          $this->currentItem->description = trim($this->currentItem->contentEncoded);
        }
        $this->currentItem->link = trim($this->currentItem->link);
        $this->currentItem->guid = trim($this->currentItem->guid);
        $this->currentItem->guidIsPermaLink = trim($this->currentItem->guidIsPermaLink);
        if ($this->feedTYPE == "FEE") {
          $this->currentItem->atomAuthorEmail = trim($this->currentItem->atomAuthorEmail);
          $this->currentItem->author = trim($this->currentItem->atomAuthorEmail);
        }
        $this->currentItem->author = trim($this->currentItem->author);
        if ($this->currentItem->creativeCommons == "") {
          $this->currentItem->creativeCommons = trim($this->FeedCreativeCommons);
        } else {
          $this->currentItem->creativeCommons = trim($this->currentItem->creativeCommons);
        }
        if ($this->operateAs == "rss2sql") {
          if (($this->currentItem->source == "") && ($this->sourceFeedURL != "")) {
            $this->currentItem->source = $this->FeedTitle;
            $this->currentItem->sourceURL = $this->sourceFeedURL;
          }
        }
        $this->currentItem->source = trim($this->currentItem->source);
        $this->currentItem->sourceURL = trim($this->currentItem->sourceURL);
        $this->currentItem->enclosureURL = trim($this->currentItem->enclosureURL);
        $this->currentItem->enclosureLength = trim($this->currentItem->enclosureLength);
        $this->currentItem->enclosureType = trim($this->currentItem->enclosureType);
        $this->currentItem->comments = trim($this->currentItem->comments);
        $this->currentItem->rssMeshExtra = trim($this->currentItem->rssMeshExtra);
        $this->currentItem->rssMeshFeedImageTitle = trim($this->currentItem->rssMeshFeedImageTitle);
        $this->currentItem->rssMeshFeedImageUrl = trim($this->currentItem->rssMeshFeedImageUrl);
        $this->currentItem->rssMeshFeedImageLink = trim($this->currentItem->rssMeshFeedImageLink);
        $this->currentItem->rssMeshFeedImageDescription = trim($this->currentItem->rssMeshFeedImageDescription);
        $this->currentItem->rssMeshFeedImageHeight = trim($this->currentItem->rssMeshFeedImageHeight);
        $this->currentItem->rssMeshFeedImageWidth = trim($this->currentItem->rssMeshFeedImageWidth);
        if ($this->operateAs == "rss2html") {
          //
          // Escape any links
          $this->currentItem->link = FeedForAll_rss2html_EscapeLink($this->currentItem->link);
          $this->currentItem->guid = FeedForAll_rss2html_EscapeLink($this->currentItem->guid);
          $this->currentItem->creativeCommons = FeedForAll_rss2html_EscapeLink($this->currentItem->creativeCommons);
          $this->currentItem->sourceURL = FeedForAll_rss2html_EscapeLink($this->currentItem->sourceURL);
          $this->currentItem->enclosureURL = FeedForAll_rss2html_EscapeLink($this->currentItem->enclosureURL);
          $this->currentItem->comments = FeedForAll_rss2html_EscapeLink($this->currentItem->comments);
          $this->currentItem->rssMeshFeedImageUrl = FeedForAll_rss2html_EscapeLink($this->currentItem->rssMeshFeedImageUrl);
          $this->currentItem->rssMeshFeedImageLink = FeedForAll_rss2html_EscapeLink($this->currentItem->rssMeshFeedImageLink);
        }
        
        //
        if ($this->currentItem->contentEncodedUsed) {
          $this->contentEncodedUsed = 1;
        }
        if (FeedForAll_parseExtensions() === TRUE) {
          FeedForAll_parseExtensions_endElemend($parser, $this, $tagName);
        }
        if ($this->UseItem) {
          $this->Items[] = $this->currentItem;
          if (isset($debugLevel) && ($debugLevel >= 3)) {
            echo "DIAG: adding to items, count=".count($this->Items)."<br>\n";
          }
        }
      } else {
        unset($this->currentItem);
      }
      $this->insideItem = FALSE;
      $this->level_item = 0;
      return;
    }
    elseif ($this->insideAtomAuthor && ($tagName == "AUTHOR")) {
      $this->insideAtomAuthor = FALSE;
    }
    elseif (($tagName == "IMAGE") && ($this->insideChannelImage)) {
      $this->FeedImageTitle = trim($this->FeedImageTitle);
      $this->FeedImageURL = trim($this->FeedImageURL);
      $this->FeedImageLink = trim($this->FeedImageLink);
      $this->FeedImageDescription = trim($this->FeedImageDescription);
      $this->FeedImageHeight = trim($this->FeedImageHeight);
      $this->FeedImageWidth = trim($this->FeedImageWidth);
      if ($this->operateAs == "rss2html") {
        //
        // Escape any links
        $this->FeedImageURL = FeedForAll_rss2html_EscapeLink($this->FeedImageURL);
        $this->FeedImageLink = FeedForAll_rss2html_EscapeLink($this->FeedImageLink);
      }
      if (FeedForAll_parseExtensions() === TRUE) {
        FeedForAll_parseExtensions_endElemend($parser, $this, $tagName);
      }
      $this->insideChannelImage = FALSE;
      $this->level_channelImage = 0;
      return;
    }
    elseif ((($tagName == "CHANNEL") && ($this->feedTYPE != "FEE")) || (($tagName == "FEED") && ($this->feedTYPE == "FEE"))) {
      $this->FeedPubDate = trim($this->FeedPubDate);
      $this->FeedPubDateDC = trim($this->FeedPubDateDC);
      $this->FeedAtomUpdated = trim($this->FeedAtomUpdated);
      //
      // Get the pubDate from pubDate first and then dc:date
      if (trim($this->FeedPubDate) != "") {
        $this->FeedPubDate_t = strtotime($this->FeedPubDate);
      }
      elseif (($this->feedTYPE == "FEE") && ($this->FeedAtomUpdated != "")) {
        $this->FeedAtomUpdated = trim($this->FeedAtomUpdated);
        $this->FeedPubDate_t = FeedForAll_scripts_getRFDdate($this->FeedAtomUpdated);
        $this->FeedPubDate = date("D, d M Y H:i:s O", $this->FeedPubDate_t);
      }
      elseif (trim($this->FeedPubDateDC) != "") {
        $this->FeedPubDate_t = FeedForAll_scripts_getRFDdate($this->FeedPubDateDC);
        $this->FeedPubDate = date("D, d M Y H:i:s O", $this->FeedPubDate_t);
      }
      elseif (trim($this->FeedLastBuildDate) != "") {
        $this->FeedPubDate_t = strtotime($this->FeedLastBuildDate);
        $this->FeedPubDate = date("D, d M Y H:i:s O", $this->FeedPubDate_t);
      } else {
        $this->FeedPubDate_t = time();
        $this->FeedPubDate = date("D, d M Y H:i:s O", $this->FeedPubDate_t);
      }
      $this->FeedTitle = trim($this->FeedTitle);
      if ($this->feedTYPE == "FEE") {
        $this->FeedAtomContent = trim($this->FeedAtomContent);
        $this->FeedDescription = $this->FeedAtomContent;
      } else {
        $this->FeedDescription = $this->FeedDescription;
      }
      if (trim($this->FeedContentEncoded) == "") {
        $this->FeedContentEncoded = $this->FeedDescription;
      }
      $this->FeedLink = trim($this->FeedLink);
      if ($this->operateAs == "rss2html") {
        //
        // Escape any links
        $this->FeedLink = FeedForAll_rss2html_EscapeLink($this->FeedLink);
        $this->FeedCreativeCommons = FeedForAll_rss2html_EscapeLink($this->FeedCreativeCommons);
      }
      if (FeedForAll_parseExtensions() === TRUE) {
        FeedForAll_parseExtensions_endElemend($parser, $this, $tagName);
      }
      $this->insideChannel = FALSE;
      $this->level_channel = 0;
      return;
    }
    elseif ($this->level == $this->level_channel) {
      if ($tagName == "TITLE") {
        $this->FeedTitle = trim($this->FeedTitle);
      }
      elseif (($tagName == "DESCRIPTION") || ($tagName == "TAGLINE")) {
        $this->FeedDescription = trim($this->FeedDescription);
      }
      elseif ($tagName == "CONTENT:ENCODED") {
        $this->FeedContentEncoded = trim($this->FeedContentEncoded);
      }
      elseif ($tagName == "LINK") {
        $this->FeedLink = trim($this->FeedLink);
      }
    }
    elseif ($tagName == "CONTENT") {
      if ($this->insideItem == TRUE) {
        // Lets look to see if the content is
        if ($this->currentItem->atomContentStartPos) {
          //
          // The the whole <content ... > string
          $pos = xml_get_current_byte_index($parser) - 2;
          if ($this->wholeString[$pos] != ">") {
            $hereToEnd = substr($this->wholeString, $pos);
            $closePos = strpos($hereToEnd, ">");
          } else {
            $closePos = 0;
          }
          $fullContentText = substr($this->wholeString, $this->currentItem->atomContentStartPos, $pos + $closePos - $this->currentItem->atomContentStartPos+1);
          // Find the end of <content
          $start = strpos($fullContentText, ">");
          $fullContentText = substr($fullContentText, $start+1);
          // Find the end of <div
          $start = strpos($fullContentText, ">");
          $fullContentText = substr($fullContentText, $start+1);
          // Find the start of </content
          $start = strrpos($fullContentText, "<");
          $fullContentText = substr($fullContentText, 0, $start-1);
          // Find the start of ></div
          $start = strrpos($fullContentText, "<");
          $this->currentItem->atomContent = substr($fullContentText, 0, $start-1);
          $this->currentItem->atomContentStartPos = 0;
        }
      } else {
        // Lets look to see if the content is
        if ($this->FeedAtomContentStartPos) {
          //
          // The the whole <content ... > string
          $pos = xml_get_current_byte_index($parser) - 2;
          if ($this->wholeString[$pos] != ">") {
            $hereToEnd = substr($this->wholeString, $pos);
            $closePos = strpos($hereToEnd, ">");
          } else {
            $closePos = 0;
          }
          $fullContentText = substr($this->wholeString, $this->FeedAtomContentStartPos, $pos + $closePos - $this->FeedAtomContentStartPos+1);
          // Find the end of <content
          $start = strpos($fullContentText, ">");
          $fullContentText = substr($fullContentText, $start+1);
          // Find the end of <div
          $start = strpos($fullContentText, ">");
          $fullContentText = substr($fullContentText, $start+1);
          // Find the start of </content
          $start = strrpos($fullContentText, "<");
          $fullContentText = substr($fullContentText, 0, $start-1);
          // Find the start of ></div
          $start = strrpos($fullContentText, "<");
          $this->FeedAtomContent = substr($fullContentText, 0, $start-1);
          $this->FeedAtomContentStartPos = 0;
        }
      }
    }
    if (FeedForAll_parseExtensions() === TRUE) {
      FeedForAll_parseExtensions_endElemend($parser, $this, $tagName);
    }
  }

  function characterData($parser, $data) {
    if (($data == "") || ($data == NULL)) {
    } else {
      if (($this->insideItem) && ($this->level == $this->level_item+1)) {
        switch ($this->tag) {
          case "TITLE":
          $this->currentItem->title .= $data;
          break;

          case "DESCRIPTION":
          $this->currentItem->description .= $data;
          break;

          case "CONTENT:ENCODED":
          $this->currentItem->contentEncodedUsed = 1;
          $this->currentItem->contentEncoded .= $data;
          break;

          case "SUMMARY":
          $this->currentItem->description .= $data;
          break;

          case "LINK":
          $this->currentItem->link .= $data;
          break;

          case "PUBDATE":
          $this->currentItem->pubDate .= $data;
          break;

          case "MODIFIED":
          $this->currentItem->pubDateDC .= $data;
          break;

          case "GUID":
          $this->currentItem->guid .= $data;
          break;
          
          case "ID":
          case "ATOM:ID":
          $this->currentItem->atomID .= $data;
          break;

          case "AUTHOR":
          $this->currentItem->author .= $data;
          break;

          case "COMMENTS":
          $this->currentItem->comments .= $data;
          break;

          case "SOURCE":
          $this->currentItem->source .= $data;
          break;

          case "CATEGORY":
          $this->currentItem->category .= $data;
          break;

          case "CREATIVECOMMONS:LICENSE":
          $this->currentItem->creativeCommons .= $data;
          break;

          case "RSSMESH:EXTRA":
          $this->currentItem->rssMeshExtra .= $data;
          break;

          case "RSSMESH:FEEDIMAGETITLE":
          $this->currentItem->rssMeshFeedImageTitle .= $data;
          break;

          case "RSSMESH:FEEDIMAGEURL":
          $this->currentItem->rssMeshFeedImageUrl .= $data;
          break;

          case "RSSMESH:FEEDIMAGELINK":
          $this->currentItem->rssMeshFeedImageLink .= $data;
          break;

          case "RSSMESH:FEEDIMAGEDESCRIPTION":
          $this->currentItem->rssMeshFeedImageDescription .= $data;
          break;

          case "RSSMESH:FEEDIMAGEHEIGHT":
          $this->currentItem->rssMeshFeedImageHeight .= $data;
          break;

          case "RSSMESH:FEEDIMAGEWIDTH":
          $this->currentItem->rssMeshFeedImageWidth .= $data;
          break;

          case "UPDATED":
          case "ATOM:UPDATED":
          $this->currentItem->atomUpdated .= $data;
          break;
          
          case "CONTENT":
          case "ATOM:CONTENT":
          $this->currentItem->atomContent .= $data;
          break;
          
          default:
          if ($this->tag == "DC:DATE") {
            $this->currentItem->pubDateDC .= $data;
          }
          if (FeedForAll_parseExtensions() === TRUE) {
            FeedForAll_parseExtensions_characterData($parser, $this, $data);
          }
        }
      }
      elseif ($this->insideChannelImage) {
        switch ($this->tag) {
          case "TITLE":
          $this->FeedImageTitle .= $data;
          break;

          case "URL":
          $this->FeedImageURL .= $data;
          break;

          case "LINK":
          $this->FeedImageLink .= $data;
          break;

          case "DESCRIPTION":
          $this->FeedImageDescription .= $data;
          break;

          case "HEIGHT":
          $this->FeedImageHeight .= $data;
          break;

          case "WIDTH":
          $this->FeedImageWidth .= $data;
          break;

          default:
          if (FeedForAll_parseExtensions() === TRUE) {
            FeedForAll_parseExtensions_characterData($parser, $this, $data);
          }
        }
      }
      elseif (($this->insideChannel) && ($this->level == $this->level_channel+1)) {
        switch ($this->tag) {
          case "TITLE":
          $this->FeedTitle .= $data;
          break;

          case "DESCRIPTION":
          $this->FeedDescription .= $data;
          break;

          case "CONTENT:ENCODED":
          $this->FeedContentEncoded .= $data;
          break;

          case "TAGLINE":
          $this->FeedDescription .= $data;
          break;

          case "LINK":
          $this->FeedLink .= $data;
          break;

          case "PUBDATE":
          $this->FeedPubDate .= $data;
          break;

          case "MODIFIED":
          $this->FeedPubDateDC .= $data;
          break;

          case "LASTBUILDDATE":
          $this->FeedLastBuildDate .= $data;
          break;

          case "CREATIVECOMMONS:LICENSE":
          $this->FeedCreativeCommons .= $data;
          break;

          case "UPDATED":
          case "ATOM:UPDATED":
          $this->FeedAtomUpdated .= $data;
          break;
          
          case "CONTENT":
          case "ATOM:CONTENT":
          $this->FeedAtomContent .= $data;
          break;
          
          default:
          if ($this->tag == "DC:DATE") {
            $this->FeedPubDateDC .= $data;
          }
          if (FeedForAll_parseExtensions() === TRUE) {
            FeedForAll_parseExtensions_characterData($parser, $this, $data);
          }
        }
      }
      elseif (($this->insideAtomAuthor) && ($this->insideItem) && ($this->level == $this->level_item+2)) {
        switch ($this->tag) {
          case "EMAIL":
          case "ATOM:EMAIL":
          $this->currentItem->atomAuthorEmail .= $data;
          break;
          
          default:
          if (FeedForAll_parseExtensions() === TRUE) {
            FeedForAll_parseExtensions_characterData($parser, $this, $data);
          }
        }
      }
      elseif (($this->insideAtomAuthor) && ($this->insideChannel) && ($this->level == $this->level_channel+2)) {
        switch ($this->tag) {
          case "EMAIL":
          case "ATOM:EMAIL":
          $this->FeedAtomAuthorEmail .= $data;
          break;
          
          default:
          if (FeedForAll_parseExtensions() === TRUE) {
            FeedForAll_parseExtensions_characterData($parser, $this, $data);
          }
        }
      } else {
        if (FeedForAll_parseExtensions() === TRUE) {
          FeedForAll_parseExtensions_characterData($parser, $this, $data);
        }
      }
    }
  }
}

if (function_exists("FeedForAll_parseExtensions_extendParserClass")) {
  $currentBaseClassName = FeedForAll_parseExtensions_extendParserClass("rootRSSParserClass");
} else {
  $currentBaseClassName = "rootRSSParserClass";
}
eval('class baseParserClassWithExtensions extends ' . $currentBaseClassName . ' {}');

class baseParserClass extends baseParserClassWithExtensions {
  Function baseParserClass($operateAs) {
    $parentClass = get_parent_class($this);
    $this->$parentClass($operateAs);
  }
}

?>
