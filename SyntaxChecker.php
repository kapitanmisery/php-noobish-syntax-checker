<?php


/**
 * Class ParseAnalyzer
 */
class SyntaxChecker
{

    protected static $_instance;

    /**
     * @return ParseAnalyzer
     */
    public static function createInstance()
    {

        if (!self::$_instance instanceof self) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    protected $rawCode = "";


    protected $rawCodeArr = array();

    protected $cleanCodeArr = array();

    protected $analyzedCodeArr = array();

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->rawCode = $code;
        return $this;
    }

    /**
     * @return $this
     */
    protected function parseCodeToArr()
    {

        $this->rawCodeArr = preg_split('/(\r\n|\n|\r)/', htmlspecialchars($this->rawCode));
        return $this;
    }


    /**
     * @return $this
     */
    protected function createCleanCodeArr()
    {


        foreach ($this->rawCodeArr as $pos => $rawCode) {
            $lineNumber = $pos + 1;
            $cleaned = trim($rawCode);
            if ((!empty($cleaned) &&
                !is_null($cleaned))
            ) {
                $this->cleanCodeArr[$lineNumber] = $cleaned;
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function analyzeCleanCodeItems()
    {
        $this->analyzedCodeArr = array();

        foreach ($this->cleanCodeArr as $lineNumber => $cleanCode) {

            $this->analyzedCodeArr[] = $this->analyzeLine($lineNumber, $cleanCode);
        }

        return $this;
    }


    /**
     * @param int $lineNumber
     * @param string $cleanCode
     * @return array
     */
    protected function analyzeLine($lineNumber, $cleanCode = "")
    {
        $validIdentifiers = array("Print", "Numeric", "String");

        $str = "[Line " . $lineNumber . "]";

        if (substr($cleanCode, -1) != ";") {
            $str .= " Syntax error: Unterminated line.";
            return  $str;
        }

        $cleanCode = rtrim($cleanCode,";");

        $parts = preg_split('/\s+/', $cleanCode);
        $keyword = $parts[0];

        if(!in_array($keyword, $validIdentifiers)) {

            $str .= " Invalid keyword [" . $keyword . "] specified.";
            return  $str;
        }

        if($keyword == "Numeric" && !is_numeric($parts[3])) {
            $str .= " Invalid numeric value [" . $parts[3] . "] specified.";
            return  $str;
        }

        if(($keyword == "Numeric" || $keyword == "String" )
            && ($parts[2] != "=")) {
            $str .= " No equal [=] operator specified upon [".$keyword."] Declration.";
            return  $str;
        }

        $str .= " Valid Syntax for [" . $cleanCode . "]";

        return $str;
    }


    /**
     * @return $this
     */
    protected function analyze()
    {
        $this->parseCodeToArr();
        $this->createCleanCodeArr();
        $this->analyzeCleanCodeItems();
        return $this;
    }


    /**
     * @return $this
     */
    protected function displayAnalysis()
    {

        echo "<p>Displaying Analysis</p>";

        foreach ($this->analyzedCodeArr as $analyzedCode) {
            echo "<p>" . $analyzedCode . "</p>";
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function analyzeAndDisplay()
    {

        return $this->analyze()->displayAnalysis();
    }
}