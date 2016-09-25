package main

import (
	"./calculation"
	"fmt"
)

func main() {
	var num int
	fmt.Scan(&num)

	result := calculation.Execute(num)
	fmt.Printf("%dの階乗＝%d\n", num, result)
}
