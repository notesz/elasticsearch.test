<?php
namespace ElasticTest\Modules\Cli\Tasks;

use ElasticTest\Common\Models\Content;

class ProcessTask extends \Phalcon\Cli\Task
{
    const DAYS = 5;

    const LIMIT = 50;

    public function mainAction()
    {

        $results = $this->getContents();

        if (count($results) > 0) {
            $bar = new \Dariuszp\CliProgressBar(count($results));
            $bar->setBarLength(100);
            $bar->display();

            foreach ($results as $rowKey => $rowValue) {
                $pageContent = $this->getContentByUrl($rowValue['url']);

                if ($pageContent['status'] == 'success') {
                    $rowValue['content'] = $this->getPlainText($pageContent['data']);
                    $rowValue['updated'] = date('Y-m-d H:i:s');

                    $content = new \ElasticTest\Common\Models\Content();

                    $content->setId($rowValue['id']);
                    $content->setUrl($rowValue['url']);
                    $content->setTitle($rowValue['title']);
                    $content->setDescription($rowValue['description']);
                    $content->setContent($rowValue['content']);
                    $content->setUpdated($rowValue['updated']);

                    if ($content->save() == false) {
                        print $rowValue['content'];die();
                    }
                }

                $bar->progress();
            }

            $bar->end();
        }

    }

    /**
     * @param $url
     *
     * @return array
     */
    private function getContentByUrl($url = '')
    {
        try {
            if (!filter_var($url, FILTER_VALIDATE_URL) !== false) {
                throw new \Exception('Invalid URL');
            }

            $urlData = get_headers($url);

            if ($urlData[0] != 'HTTP/1.1 200 OK') {
                throw new \Exception($urlData[0]);
            }

            $content = file_get_contents($url);

            return [
                'status' => 'success',
                'data' => $content
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'data' => $e->getMessage()
            ];
        }
    }

    /**
     * @return array
     */
    private function getContents()
    {
        $results = [];

        $key = 0;
        foreach (\ElasticTest\Common\Models\Content::find(
            array(
//                'updated < :lastdate:',
//                'bind'  => array(
//                    'lastdate' => date('Y-m-d H:i:s', strtotime('-' . self::DAYS . ' days'))
//                ),
                'order' => 'updated ASC',
                'limit' => self::LIMIT
            )
        ) as $row) {
            $results[$row->id] = [
                'id'  => $row->id,
                'url' => $row->url,
                'title' => $row->title,
                'description' => $row->description,
                'content' => $row->content,
                'updated' => $row->updated
            ];
        }

        return $results;
    }

    /**
     * @param $content
     *
     * @return string
     */
    private function getPlainText($content)
    {
        $plaintext = \Sunra\PhpSimple\HtmlDomParser::str_get_html($content);
        $plaintext = $plaintext->plaintext;
        $plaintext = preg_replace('/\s+/', ' ', $plaintext);

        return $plaintext;
    }

}
