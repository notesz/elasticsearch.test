<?php

class ContentController extends ControllerBase
{
    const SUCCESS = 'success';

    const ERROR = 'error';

    /**
     * Add new url.
     *
     * @return void
     */
    public function addAction()
    {
        if ($this->request->isPost()) {
            $result = $this->saveContent();

            if ($result['result'] == self::SUCCESS) {
                $this->flashSession->success('Success!');
            } else {
                $this->flashSession->error($result['message']);
            }

            return $this->response->redirect(
                $this->url->get(array('for' => 'content-add'))
            );
        }
    }

    /**
     * Add new url to content table.
     *
     * @return array
     */
    protected function saveContent()
    {
        try {
            $url = $this->request->getPost('url');

            if (!filter_var($url, FILTER_VALIDATE_URL) !== false) {
                throw new \Exception('Invalid URL');
            }

            $content = new \Content();

            $content->setId(null);
            $content->setTitle('-');
            $content->setDescription('-');
            $content->setContent('-');
            $content->setUpdated('1976-01-10 12:30:00');
            $content->setUrl($url);

            $content->save();

            if ($content->save() === false) {
                $messages = $content->getMessages();

                $resultMessage = '';
                foreach ($messages as $message) {
                    $resultMessage .= $message . PHP_EOL;
                }

                throw new \Exception($resultMessage);
            }

        } catch (\Exception $e) {
            return [
                'result'  => self::ERROR,
                'message' => $e->getMessage()
            ];
        }

        return [
            'result' => self::SUCCESS,
            'message' => ''
        ];
    }

}
