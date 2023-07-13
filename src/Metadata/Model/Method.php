<?php

declare(strict_types=1);

namespace Soap\Engine\Metadata\Model;

use Soap\Engine\Metadata\Collection\ParameterCollection;

final class Method
{
    private ParameterCollection $parameters;
    private ?XsdType $header;
    private string $name;
    private XsdType $returnType;
    private MethodMeta $meta;

    public function __construct(string $name, ?XsdType $header, ParameterCollection $parameters, XsdType $returnType)
    {
        $this->name = $name;
        $this->returnType = $returnType;
        $this->header = $header;
        $this->parameters = $parameters;
        $this->meta = new MethodMeta();
    }

    public function getParameters(): ParameterCollection
    {
        return $this->parameters;
    }

    public function getHeader(): ?XsdType
    {
        return $this->header;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getReturnType(): XsdType
    {
        return $this->returnType;
    }

    public function getMeta(): MethodMeta
    {
        return $this->meta;
    }

    /**
     * @param callable(MethodMeta): MethodMeta $metaProvider
     */
    public function withMeta(callable $metaProvider): self
    {
        $new = clone $this;
        $new->meta = $metaProvider($this->meta);

        return $new;
    }
}
